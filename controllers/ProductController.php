<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use yii\web\HttpException;
use app\models\GiftFinderForm;
use yii\helpers\StringHelper;

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
        $description = 'description_' . Yii::$app->language;
        $this->setMeta("{$product->name} | Infinity roses", $product->keywords, $product->$description);
        return $this->render('view', compact('product', 'lang'));

    }

    public function actionGiftFinder() {
        $model = new GiftFinderForm();
        if (Yii::$app->request->get()) {
            $price_arr = StringHelper::explode(Yii::$app->request->get('price', ','));
            $model->price_min = $price_arr[0];
            $model->price_max = $price_arr[1];
        }
        $products = Product::find()
        ->andWhere(['>', 'price', $model->price_min])
        ->andWhere(['<', 'price', $model->price_max])
        ->all();
        return $this->render('finder', compact('model', 'products'));
    }

}

?>
