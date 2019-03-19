<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Category;
use app\models\Product;

class Navbar extends Widget {

    public $categories;
    public $products;
    public $description;
    public $id;
    public $navHtml;
    public $lang;


    public function init() {
        parent::init();
        $this->products = Product::find()->with('prices')->all();
        $this->categories = Category::find()->with('product')->all();
        if (Yii::$app->language == 'en') {
            $this->lang = 0;
          } else if (Yii::$app->language == 'ru') {
            $this->lang = 1;
        }
    }

    public function run() {
        // get cache
        if (Yii::$app->user->isGuest) {
            $nav = Yii::$app->cache->get('nav');
            if ($nav) return $nav;
        }

        $this->navHtml = $this->catToTemplate();

        // set cache
        if (Yii::$app->user->isGuest) {
            Yii::$app->cache->set('nav', $this->navHtml, 60);
        } else {
            Yii::$app->cache->delete('nav');
        }

        return $this->navHtml;
    }

    protected function catToTemplate() {
        ob_start();
        include 'navbar/navHtml.php';
        return ob_get_clean();
    }

}

?>