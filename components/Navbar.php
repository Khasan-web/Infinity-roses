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
        $this->products = Product::find()->with('prices')->all();
        $this->categories = Category::find()->with('product')->all();
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