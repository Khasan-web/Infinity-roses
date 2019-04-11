<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Gallery;
use app\modules\admin\models\GallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\modules\admin\models\Category;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends Controller
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
     * Lists all Gallery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gallery();
        $dropdownArr = [];
        $categories = Category::find()->asArray()->all();
        foreach ($categories as $category) {
            $dropdownArr[$category['id']] = $category['name_en'];
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->gallery = UploadedFile::getInstances($model, 'gallery');
            // upload function
            if ($model->validate()) {
                foreach ($model->gallery as $file) {
                    $rand_num = rand(100, 10000);
                    $path = 'upload/store/gallery/' . $file->basename . $rand_num . '.' . $file->extension;
                    $file->saveAs($path);
                    $gallery_model = new Gallery();
                    $gallery_model->img = $file->basename . $rand_num . '.' . $file->extension;
                    $gallery_model->category_id = $model->category_id;
                    $gallery_model->save();
                }
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'dropdownArr' => $dropdownArr,
        ]);
    }

    /**
     * Deletes an existing Gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $img = Gallery::findOne($id);
        unlink("upload/store/gallery/$img->img");
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
