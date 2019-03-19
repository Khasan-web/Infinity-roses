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
            $hits = Product::find()->where(['hit' => '1'])->with('category')->limit(4)->all();
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
        
        // get max and min price
        $prods = Product::find()->all();
        $minmax = [
            'min' => 0,
            'max' => 0,
        ];
        $i = 0;
        foreach ($prods as $product) {

            // minmax
            foreach ($product->prices as $price) {
                if ($i == 0) {
                    $minmax['min'] = $price->price;
                    $minmax['max'] = $price->price;
                    $i++;
                } else {
                    $price->price < $minmax['min'] ? $minmax['min'] = $price->price : $minmax['min'];
                    $price->price > $minmax['max'] ? $minmax['max'] = $price->price : $minmax['max'];
                }
            }
        }

        // get price from GET

        // variables - aspects
        // * $price;
        // * $event;
        // * $her;
        // * $him;
        // * $home;
        // * $fresh;
        // * $infinity;

        // conditions
        // 1. if not her and him -> both
        // 2. if her -> him and if him -> her

        // get parametrs
        $get = Yii::$app->request->get();
        if ($get['price']) {
            $price = $get['price'];
            $event = $get['event'];
            $her = $get['her'];
            $him = $get['him'];
            $home = $get['home'];
            $fresh = $get['fresh'];
            $infinity = $get['infinity'];
        } else {
            $price = $get['GiftFinderForm']['price'];
            $price = $get['GiftFinderForm']['price'];
            $event = $get['GiftFinderForm']['event'];
            $her = $get['GiftFinderForm']['her'];
            $him = $get['GiftFinderForm']['him'];
            $home = $get['GiftFinderForm']['home'];
            $fresh = $get['GiftFinderForm']['fresh'];
            $infinity = $get['GiftFinderForm']['infinity'];
        }

        // all boolean - if everything false - everything true
        if (!$event && !$her && !$him && !$home && !$fresh && !$infinity) {
            $all_boolean = true;
        } else {
            $all_boolean = false;
        }

        // check parametrs
        if ($price) {

            // get min and max from parametrs
            $price_arr = StringHelper::explode($price, ',', $trim = true);
            $model->price_min = $price_arr[0];
            $model->price_max = $price_arr[1];

            // appropriate products - array
            $products = [];
            foreach ($prods as $product) {
                $count = count($product->prices);
                for ($i = 0; $i < $count; $i++) {

                    // push products by aspects
                    $keywods_exp = explode(' ', $product->keywords);
                    foreach ($keywods_exp as $key) {

                        // 1. event    
                        if ($key == 'event' && $event || $all_boolean) {
                            $products += [
                                "$product->id" => $product,
                            ];
                        }

                        // 2. her
                        if ($key == 'her' && $her || $all_boolean) {
                            $products += [
                                "$product->id" => $product,
                            ];
                        } else {
                            // 3. him
                            if ($key == 'him' && $him || $all_boolean) {
                                $products += [
                                    "$product->id" => $product,
                                ];
                            }   
                        }

                        // 4. home
                        if ($key == 'home' && $home || $all_boolean) {
                            $products += [
                                "$product->id" => $product,
                            ];
                        }

                    }
                    // 5. fresh
                    if ($product->category->name_en == 'Fresh Roses' && $fresh || $all_boolean) {
                        $products += [
                            "$product->id" => $product,
                        ];
                    }
                    
                    // 6. infinity
                    if ($product->category->name_en == 'Infinity Roses' && $infinity || $all_boolean) {
                        $products += [
                            "$product->id" => $product,
                        ];
                    }

                // set price diapazon on result
                // 7. Prices

                $products_count = count($products);
                foreach ($products as $product) {
                    $max_product_price = $product->prices[0]->price;
                    $min_product_price = $product->prices[0]->price;
                    foreach ($product->prices as $price) {
                        if ($price > $max_product_price) {
                            $max_product_price = $price->price;
                        }
                        if ($price < $min_product_price) {
                            $min_product_price = $price->price;
                        }
                    }
                    if ($min_product_price >= $model->price_min && $max_product_price <= $model->price_max) {
                        // everything is awesome ))
                    } else {
                        // delete unapprpriate element
                        unset($products[$product->id]);
                    }
                }

                }
            }
            
        } else {
            $model->price_min = $minmax['min'];
            $model->price_max = $minmax['max'];
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
            $img_info = explode('_', $image->name);
            $color_name = '';
            $image_position = '';
            $color_name = $img_info[0];
            $image_position = $img_info[1];
            if ($image_position == $position) {
                $imagesToAjax[$i] = $image;
            }
        }

        $this->layout = false;
        return $this->render('images', compact('imagesToAjax'));
    }

}

?>