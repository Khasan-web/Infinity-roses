<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\CategoryT;
use app\models\Product;
use app\models\ProductT;
use yii\web\HttpException;

class CategoryController extends AppController {
    
    public function actionView() {
        $id = Yii::$app->request->get('id');
        $category = Category::findOne($id);
        if ($category == null) {
            throw new HttpException(404, 'This category does not exist');
        }
        $products = Product::find()->where(['category_id' => $id])->all();
        if (Yii::$app->language == 'en') {
            $lang = 0;
        } else if (Yii::$app->language == 'ru') {
            $lang = 1;
        }
        $name = 'name_' . Yii::$app->language;
        $description  = 'description_' . Yii::$app->language;
        $this->setMeta("{$category->$name} | Infinity roses", $category->keywords, $category->$description);
        return $this->render('view', compact('category', 'products', 'lang', 'name', 'description'));
    }

    public function actionSearch() {
        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta("{$q} | Infitiy roses");
        if (!$q) {
            return $this->render('search');
        }
        $products = Product::find()->where(['like', 'name', $q])->all();
        return $this->render('search', compact('products', 'q'));
    }
    
}

?>