<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;

class CartController extends AppController {

    public function actionView() {
        return $this->render('view');
    }

}

?>