<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use yii\web\HttpException;

class ProductController extends AppController {

    public function actionView() {
        $id = Yii::$app->request->get('id');
        if (Yii::$app->language == 'en') {
            $lang = 0;
          } else if (Yii::$app->language == 'ru') {
            $lang = 1;
        }
        $product = Product::findOne($id);
        if ($product == null) {
            throw new HttpException(404, 'This product does not exist');
        }
        $this->setMeta("{$product->name} | Infinity roses", $product->keywords, $product->description);
        return $this->render('view', compact('product', 'lang'));

    }

}

?>
