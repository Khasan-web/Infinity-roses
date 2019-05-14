<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\CategoryT;
use app\models\Product;
use app\models\ProductT;
use yii\web\HttpException;
use app\models\Gallery;

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
        ->orWhere(['like', 'description_en', $q])
        ->orWhere(['like', 'description_ru', $q])
        ->orWhere(['like', 'keywords', $q])
        ->all();
        $this->layout = false;
        return $this->render('search-li', compact('products'));
    }

    public function actionCelebrationDecoration() {
        $category = Category::findOne(4);
        $name = 'name_' . Yii::$app->language;
        $gallery = Gallery::find()->asArray()->where(['category_id' => $category->id])->all();
        $description = 'description_' . Yii::$app->language;
        $this->setMeta(Yii::t('app', 'Celebration Decoration'), null, 'celebration decoration tashket декорыция мероприятий ташкент');
        return $this->render('celebration-decoration', compact('category', 'name', 'description', 'gallery'));
    }

    public function actionBusiness() {
        $business_category = Category::find()->where(['name_en' => 'Roses for Business'])->one();
        $name = getLang('name');
        $description = getLang('description');
        $this->setMeta(Yii::t('app', 'Roses for business'));
        return $this->render('business', compact('business_category', 'name','description'));
    }
    
}

?>