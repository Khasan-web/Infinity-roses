<?php

namespace app\components;

use Yii;
use yii\base\Widget;

class AdminNavbar extends widget {

    public $html;

    public $home;
    public $products;
    public $categories;
    public $orders;
    public $events;
    public $gallery;

    public function init() {
        parent::init();
    }

    public function run() {
        $controller = Yii::$app->controller->id;
        if ($controller == 'default') {
            $this->home = 'active';
        } else if ($controller == 'product') {
            $this->products = 'active';
        } else if ($controller == 'category') {
            $this->categories = 'active';
        } else if ($controller == 'order') {
            $this->orders = 'active';
        } else if ($controller == 'events') {
            $this->events = 'active';
        } else if ($controller == 'gallery') {
            $this->gallery = 'active';
        }
        $html = include __DIR__ . '/adminNavbar/adminNavbarHtml.php';
        return $this->html;
    }

}

?>