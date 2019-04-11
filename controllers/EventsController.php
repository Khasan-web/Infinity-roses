<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Events;
use yii\web\HttpException;

class EventsController extends AppController {

    public function actionView($id) {
        $event = Events::findOne($id);
        if (empty($event)) {
            throw new HttpException(404, 'The Event Not Found');
        }
        $description = 'description_' . Yii::$app->language;
        $name = 'name_' . Yii::$app->language;
        $this->setMeta($event->$name);
        return $this->render('view', compact('event', 'description', 'name'));
    }

}

?>
