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

        // caching category
        if (Yii::$app->cache->exists($id . '_category')) {
            $category = Yii::$app->cache->get($id . '_category');
        } else {
            $category_cache = Category::findOne($id);
            Yii::$app->cache->set($id . '_category', $category_cache, 60);
            $category = $category_cache;
        }
        // end caching category

        if ($category == null) {
            throw new HttpException(404, 'This category does not exist');
        }

        // caching products of certain category
        if (Yii::$app->cache->exists($id . '_prods')) {
            $products = Yii::$app->cache->get($id . '_prods');
        } else {
            $products_cache = Product::find()->where(['category_id' => $id])->all();
            Yii::$app->cache->set($id . '_prods', $products_cache, 60);
            $products = $products_cache;
        }
        // end caching products of certain category

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

    public function actionDecorationOfEvents() {
        // caching category
        if (Yii::$app->cache->exists('events-decoration_category')) {
            $category = Yii::$app->cache->get('events-decoration_category');
        } else {
            $category_cache = Category::find()->where(['like', 'keywords', '%events-decoration%', false])->one();
            Yii::$app->cache->set('events-decoration_category', $category_cache, 60);
            $category = $category_cache;
        }
        // end caching category
        $name = getLang('name');
        $gallery = Gallery::find()->asArray()->where(['category_id' => $category->id])->all();
        $description = getLang('description');
        $this->setMeta(Yii::t('app', 'Decoration of Events'), null, 'Decoration of Events tashket декорыция мероприятий ташкент');
        return $this->render('events-decoration', compact('category', 'name', 'description', 'gallery'));
    }

    public function actionBusiness() {
        $business_category = Category::find()->where(['name_en' => 'Roses for Business'])->one();
        $name = getLang('name');
        $description = getLang('description');
        $this->setMeta(Yii::t('app', 'Roses for business'));
        return $this->render('business', compact('business_category', 'name','description'));
    }
    
}