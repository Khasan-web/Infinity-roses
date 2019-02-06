<?php

namespace app\controllers;

use Yii;

class CategoryController extends AppController {
    
    public function actionView() {
        return $this->render('view');
    }
    
}

?>