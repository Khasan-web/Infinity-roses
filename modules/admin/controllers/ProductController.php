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
use app\modules\admin\models\Color;
use rico\yii2images\models\Image;

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
        $colors = Color::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('update', 'Good job! Now please add sizes of the product - 2nd panel');
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'colors' => $colors,
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
        $colors = Color::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->image) {
                $model->upload();
            }
            unset($model->image);

            $model->gallery = UploadedFile::getInstances($model, 'gallery');

            // images qty in gallery
            $images_arr = [];
            $all_data_exploded = explode(',', $model->size_list);

            // link data from size_list input with uploaded images by index (last part in the string color_position_size_index)
            if (is_array($all_data_exploded)) {
                $i = 0;
                foreach ($all_data_exploded as $data) {
                    // exploded color_position_size_index
                    $data_exploded = explode('_', $data);

                    // create an array with img object and array with info about color position and size
                    $img_data = [
                        'img' => $model->gallery[$i],
                        'info' => $data,
                    ];
                    array_push($images_arr, $img_data);
                    $i++;
                }
            } else if (!is_null($model->size_list)) {
                // exploded color_position_size_index
                $data_exploded = explode('_', $model->size_list);

                // create an array with img object and array with info about color position and size
                $img_data = [
                    'img' => $model->gallery[0],
                    'info' => $model->size_list,
                ];
                array_push($images_arr, $img_data);
            } else {
                return false;
            }

            if (!empty($model->not_available)) {
                // set not available products
                $non_available_exploded = explode(',', $model->not_available);
                foreach ($non_available_exploded as $color) {
                    $data = explode('_', $color);
                    $img_id = $data[0];
                    $status = $data[1];

                    // get image and divide its name to parts
                    $image = Image::findOne($img_id);
                    $image_name_data = explode('_', $image->name);
                    $str_data = $image_name_data[0] . '_' . $image_name_data[1] . '_' . $image_name_data[2] . '_' . $image_name_data[3];
                    // update image
                    $image->name = $str_data . '_' . $status;
                    $image->update();
                }
            }

            // upload gallery
            if ($model->gallery) {
                $model->uploadGallery($images_arr);
            }

            Yii::$app->session->setFlash('success', 'The product was updated');
            $imgs_existing = Product::findOne($id);
            $img = $imgs_existing->getImage();
            if (empty($model->gallery)) {
                if ($img->name) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('add_sizes', 'Last step: Please add images of the product');
                    return $this->redirect(['update', 'id' => $model->id]);
                }
            } else {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'pricesModel' => $pricesModel,
            'colors' => $colors,
        ]);
    }

    public function actionAddSizes()
    {
        $id = Yii::$app->request->get('id');
        $addedSizes = Yii::$app->request->get('sizes');
        $search_keys = ['roses', 'rose', 'stems', 'stem'];
        foreach ($addedSizes as $size) {
            $addSizesModel = new Price();
            $addSizesModel->size = $size['size'];
            $addSizesModel->size_ru = $size['size_ru'];
            if (isset($size['width']) && isset($size['height'])) {
                $addSizesModel->width = $size['width'];
                $addSizesModel->height = $size['height'];
            }
            $addSizesModel->price = $size['price'];
            $addSizesModel->product_id = $id;
            $addSizesModel->save();
        }
        return true;
    }

    public function actionRemoveSize()
    {
        $id = Yii::$app->request->get('id');
        $product_id = Yii::$app->request->get('product_id');
        $size = Price::findOne($id);
        $size->delete();
        $pricesModel = Price::find()->where(['product_id' => $product_id])->all();

        $this->layout = false;
        return $this->render('sizes', compact('pricesModel'));
    }

    public function actionRemoveImage($alias, $id)
    {
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

    public function actionRemoveAll() {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if (!empty($product)) {
            $product->removeImages();
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
        $model = $this->findModel($id);
        $sizes = Price::find()->where(['product_id' => $id])->all();
        foreach ($sizes as $size) {
            $size->delete();
        }
        $model->removeImages();
        $model->delete();
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
