<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Order;

class AdminNotification extends widget {

    public $html;
    public $orders;

    public function init() {
        parent::init();
    }

    public function run() {
        $orders = Order::find()->where(['status' => '0'])->asArray()->all();
        $html = include __DIR__ . '/adminNotification/notificationHtml.php';
        return $this->html;
    }

}


?>