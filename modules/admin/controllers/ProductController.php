<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Product;
use app\modules\admin\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Price;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends AppAdminController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $products = Product::find()->all();
        $last_id = 1;
        foreach ($products as $product) {
            if ($last_id < $product->id) {
                $last_id = $product->id;
            }
        }

        if (Yii::$app->request->isAjax) {
            $addedSizes = Yii::$app->request->get('sizes');
            foreach ($addedSizes as $size) {
                $addSizesModel = new Price();
                $addSizesModel->size = $size['size'];
                $addSizesModel->price = $size['price'];
                $addSizesModel->product_id = $last_id + 1;
                $addSizesModel->save();
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->image) {
                $model->upload();
            }
            unset($model->image);

            $model->gallery = UploadedFile::getInstances($model, 'gallery');
            $model->uploadGallery();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        $pricesModel = Price::find()->where(['product_id' => $id])->all();
        
        if (Yii::$app->request->isAjax) {
            $addedSizes = Yii::$app->request->get('sizes');
            foreach ($addedSizes as $size) {
                $addSizesModel = new Price();
                $addSizesModel->size = $size['size'];
                $addSizesModel->price = $size['price'];
                $addSizesModel->product_id = $id;
                $addSizesModel->save();
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->image) {
                $model->upload();
            }
            unset($model->image);

            $model->gallery = UploadedFile::getInstances($model, 'gallery');
            $model->uploadGallery();

            Yii::$app->session->setFlash('success', 'The product was updated');
            return $this->redirect(['view', 'id' => $model->id]);

        }

        return $this->render('update', [
            'model' => $model,
            'pricesModel' => $pricesModel,
        ]);
    }

    public function actionRemoveSize() {
        $id = Yii::$app->request->get('id');
        $product_id = Yii::$app->request->get('product_id');
        $size = Price::findOne($id);
        $size->delete();
        $pricesModel = Price::find()->where(['product_id' => $product_id])->all();

        $this->layout = false;
        return $this->render('sizes', compact('pricesModel'));
    }

    public function actionRemoveImage($alias, $id) {
        $product = Product::findOne($id);
        if ($product) {
            $images = $product->getImages();
            foreach ($images as $img) {
                if ($img->urlAlias == $alias) {
                    $product->removeImage($img);
                }
            }
            return true;
        } else {
            return false;
        }

    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $product = Product::findOne($id);
        $product->removeImages();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
