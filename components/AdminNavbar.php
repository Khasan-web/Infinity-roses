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

    public function init() {
        parent::init();
    }

    public function run() {
        $controller = Yii::$app->controller->id;
        if ($controller == 'default') {
            $home = 'active';
        } else if ($controller == 'product') {
            $products = 'active';
        } else if ($controller == 'category') {
            $categories = 'active';
        } else if ($controller == 'order') {
            $orders = 'active';
        } else if ($controller == 'events') {
            $events = 'active';
        }
        $html = include __DIR__ . '/adminNavbar/adminNavbarHtml.php';
        return $this->html;
    }

}

?>