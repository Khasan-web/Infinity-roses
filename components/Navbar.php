<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Category;
use app\models\Product;

class Navbar extends Widget {

    public $categories;
    public $products;
    public $navHtml;
    public $lang;
    public $current_action;

    public function init() {
        parent::init();

        // caching products
        if (Yii::$app->cache->exists('products')) {
            $this->products = Yii::$app->cache->get('products');
        } else {
            $products_cache = Product::find()->with('prices')->all();
            Yii::$app->cache->set('products', $products_cache, 60);
            $this->products = $products_cache;
        }
        // end caching products

        // caching categories
        if (Yii::$app->cache->exists('categories')) {
            $this->categories = Yii::$app->cache->get('categories');
        } else {
            $categories_cache = Category::find()->with('product')->with('category')->all();
            Yii::$app->cache->set('categories', $categories_cache, 60);
            $this->categories = $categories_cache;
        }
        // end caching categories

        $this->current_action = Yii::$app->controller->action->id;
        if (Yii::$app->language == 'en') {
            $this->lang = 0;
          } else if (Yii::$app->language == 'ru') {
            $this->lang = 1;
        }
    }

    public function run() {
        // get cache
        // $nav = Yii::$app->cache->get('nav');
        // if ($nav) {
        //     return $nav;
        // } else {
        //     $this->navHtml = $this->catToTemplate();
        //     Yii::$app->cache->set('nav', $this->navHtml, 100);
        // }
        $this->navHtml = $this->catToTemplate();

        return $this->navHtml;
    }

    protected function catToTemplate() {
        ob_start();
        include 'navbar/navHtml.php';
        return ob_get_clean();
    }

}

?>