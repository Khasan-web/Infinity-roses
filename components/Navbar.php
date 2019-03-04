<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Category;

class Navbar extends Widget {

    public $categories;
    public $products;
    public $description;
    public $id;
    public $navHtml;
    public $lang;


    public function init() {
        parent::init();
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

        $this->categories = Category::find()->with('product')->all();
        $this->navHtml = $this->catToTemplate();

        // set cache
        if (Yii::$app->user->isGuest) {
            Yii::$app->cache->set('nav', $this->navHtml, 3600);
        } else {
            Yii::$app->cache->delete('nav');
        }

        return $this->navHtml;
    }

    protected function catToTemplate() {
        ob_start();
        include '/navbar/navHtml.php';
        return ob_get_clean();
    }

}

?>