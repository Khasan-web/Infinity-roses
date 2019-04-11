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
        $name = getLang('name');
        $description  = 'description_' . Yii::$app->language;
        $this->setMeta($category->$name, $category->keywords, $category->$description);
        return $this->render('view', compact('category', 'products', 'lang', 'name', 'description'));
    }

    public function actionSearch() {
        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta($q);
        if (!$q) {
            return $this->render('search');
        }
        $name = getLang('name');
        $products = Product::find()
        ->where(['like', 'name', $q])
        ->orWhere(['like', 'description_en', $q])
        ->orWhere(['like', 'description_ru', $q])
        ->orWhere(['like', 'keywords', $q])
        ->all();
        return $this->render('search', compact('products', 'q', 'name'));
    }

    public function actionGetProducts() {
        $q = trim(Yii::$app->request->get('q'));
        $products = Product::find()
        ->where(['like', 'name', $q])
        // ->orWhere(['like', 'description_en', $q])
        // ->orWhere(['like', 'description_ru', $q])
        ->orWhere(['like', 'keywords', $q])
        ->all();
        $this->layout = false;
        return $this->render('search-li', compact('products'));
    }

    public function actionWeddingDecoration() {
        $this->setMeta(Yii::t('app', 'Wedding decoration'), null, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, veniam. Aspernatur deserunt debitis asperiores est.');
        return $this->render('wedding-decoration');
    }
    
}

?>