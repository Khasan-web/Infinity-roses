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
            $name = 'name_en';
          } else if (Yii::$app->language == 'ru') {
            $lang = 1;
            $name = 'name_ru';
        }
        $product = Product::findOne($id);
        if (Yii::$app->cache->get('hits')) {
            $hits = Yii::$app->cache->get('hits');
        } else {
            $hits = Product::find()->where(['hit' => '1'])->with('category')->all();
            Yii::$app->cache->set('hits', $hits, 1800);
        }
        if ($product == null) {
            throw new HttpException(404, 'This product does not exist');
        }
        $description = 'description_' . Yii::$app->language;
        $this->setMeta($product->name, $product->keywords, $product->$description);
        return $this->render('view', compact('product', 'hits', 'lang', 'name'));

    }

    public function actionGiftFinder() {
        $model = new GiftFinderForm();
        $name = 'name_' . Yii::$app->language;
        
        if (Yii::$app->cache->get('minmax')) {
            $minmax = Yii::$app->cache->get('minmax');
        } else {
            // get max and min price
            $prods = Product::find()->all();
            $minmax = [
                'min' => 0,
                'max' => 0,
            ];
            foreach ($prods as $product) {
                if ($minmax['max']) {
                    if ($minmax['max'] < $product->price) {
                        $minmax['max'] = $product->price;
                    }
                } else {
                    $minmax['max'] = $product->price;
                }

                if ($minmax['min']) {
                    if ($minmax['min'] > $product->price) {
                        $minmax['min'] = $product->price;
                    }
                } else {
                    $minmax['min'] = $product->price;
                }
            }
            
            Yii::$app->cache->set('minmax', $minmax);
        }

        if (Yii::$app->request->get()) {
            $price_arr = StringHelper::explode(Yii::$app->request->get('price'), ',', $trim = true);
            $model->price_min = $price_arr[0];
            $model->price_max = $price_arr[1];
            $products = Product::find()
            ->andWhere(['>=', 'price', $model->price_min])
            ->andWhere(['<=', 'price', $model->price_max])
            ->all();
        }

        $this->setMeta(Yii::t('app', 'Gift finder'));
        return $this->render('finder', compact('model', 'products', 'name', 'minmax'));
    }

    public function actionGetImages() {
        $id = Yii::$app->request->get('id');
        $position = Yii::$app->request->get('position');
        $product = Product::findOne($id);
        $images = $product->getImages();
        $imagesToAjax;
        $i = 0;
        foreach ($images as $image) {
            $i++;
            $color_split = str_split($image->name);
            $image_position = '';
            foreach ($color_split as $char) {
                $char = strtolower($char);
                if (preg_match('/[0-9]/', $char)) {
                    $image_position = $char;
                }
            }
            if ($image_position == $position) {
                $imagesToAjax[$i] = $image;
            }
        }

        $this->layout = false;
        return $this->render('images', compact('imagesToAjax'));
    }

}

?>