<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Events;
use yii\web\HttpException;

class EventsController extends AppController {

    public function actionView($id) {
        $event = Events::findOne($id);
        $description = 'description_' . Yii::$app->language;
        $this->setMeta($event->name . ' | Infinity roses');
        return $this->render('view', compact('event', 'description'));
    }

}

?>
