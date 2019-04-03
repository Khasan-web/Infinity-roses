<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use yii\web\HttpException;
use app\models\GiftFinderForm;
use yii\helpers\StringHelper;

class ProductController extends AppController
{

    public function actionView()
    {
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

    public function actionGiftFinder()
    {
        $model = new GiftFinderForm();
        $name = 'name_' . Yii::$app->language;
        $request = Yii::$app->request;

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

        // GET params from gift finder
        $price = $request->get('price');
        $event = isset($_GET['event']) ? true : false;
        $her = isset($_GET['her']) ? true : false;
        $him = isset($_GET['him']) ? true : false;
        $home = isset($_GET['her']) ? true : false;
        $infinity = isset($_GET['infinity']) ? true : false;
        $fresh = isset($_GET['fresh']) ? true : false;
        $price = explode(',', $price);

        // search a specific key in keywords
        function searchKey($key, $product)
        {
            if (isset($_GET["$key"])) {
                $key_existing = strpos($product->keywords, $key);
                return $key_existing ? true : false;
            } else {
                return false;
            }
        }

        // filter all product
        $product_count_prods = count($prods);
        // array of appropriate products
        $products = [];

        for ($i = 0; $i < $product_count_prods; $i++) {
            $selected_type = false;

            // infinity
            // and if all roses in luxury collection will be infinity then new condition that (... || $prods[$i]->category->name_en == 'Luxury Collection')
            if ($infinity) {
                $selected_type = 'Infinity Roses';
            }

            // fresh
            if ($fresh) {
                $selected_type = 'Fresh Roses';
            }

            // both
            if ($infinity and $fresh) {
                $selected_type = false;
            }

            // check if switched filter is one and it is infinity roses filter
            if (count($request->get()) == 2 && isset($_GET['infinity'])) {
                if ($prods[$i]->category->name_en == 'Infinity Roses') {
                    array_push($products, $prods[$i]);
                }
            }

            // check if switched filter is one and it is fresh roses filter
            if (count($request->get()) == 2 && isset($_GET['fresh'])) {
                if ($prods[$i]->category->name_en == 'Fresh Roses') {
                    array_push($products, $prods[$i]);
                }
            }

            // check if switched filters are fresh roses filter and infinity roses filter
            if (count($request->get()) == 3 && isset($_GET['infinity']) && isset($_GET['fresh'])) {
                if ($prods[$i]->category->name_en == 'Infinity Roses') {
                    array_push($products, $prods[$i]);
                }
                if ($prods[$i]->category->name_en == 'Fresh Roses') {
                    array_push($products, $prods[$i]);
                }
            }

            // event
            if (searchKey('event', $prods[$i])) {
                if ($selected_type) {
                    if ($prods[$i]->category->name_en == $selected_type) {
                        array_push($products, $prods[$i]);
                    }
                } else {
                    array_push($products, $prods[$i]);
                }
            }

            // her
            if (searchKey('her', $prods[$i])) {
                if ($selected_type) {
                    if ($prods[$i]->category->name_en == $selected_type) {
                        array_push($products, $prods[$i]);
                    }
                } else {
                    array_push($products, $prods[$i]);
                }
            }

            // him
            if (searchKey('him', $prods[$i])) {
                if ($selected_type) {
                    if ($prods[$i]->category->name_en == $selected_type) {
                        array_push($products, $prods[$i]);
                    }
                } else {
                    array_push($products, $prods[$i]);
                }
            }

            // home
            if (searchKey('home', $prods[$i])) {
                if ($selected_type) {
                    if ($prods[$i]->category->name_en == $selected_type) {
                        array_push($products, $prods[$i]);
                    }
                } else {
                    array_push($products, $prods[$i]);
                }
            }
        }

        // // show all products, if all filters off 
        // if (empty($request->get())) {
        //     $products = $prods;
        // }
        // if there is only price filter
        $product_count = count($products);
        if (count($request->get()) == 1 && $request->get('price')) {
            if ($price[0] != $minmax['min'] || $price[1] != $minmax['max']) {
                $products = $prods;
                for ($i = 0; $i < $product_count; $i++) {
                    // price filter
                    $min_price = $products[$i]->prices[0]->price;
                    $product_sizes = (array)$products[$i]->prices;
                    foreach ($product_sizes as $size) {
                        if ($size->price < $min_price) {
                            $min_price = $size->price;
                        }
                    }
                    if ($min_price >= $price[0] && $min_price <= $price[1]) {
                        // everything is ok 
                    } else {
                        unset($products[$i]);
                    }
                    // price filter end
                }
            } else {
                $products = $prods;
            }
        } else {
            for ($i = 0; $i < $product_count; $i++) {
                // price filter
                $min_price = $products[$i]->prices[0]->price;
                $product_sizes = (array)$products[$i]->prices;
                foreach ($product_sizes as $size) {
                    if ($size->price < $min_price) {
                        $min_price = $size->price;
                    }
                }
                if ($min_price >= $price[0] && $min_price <= $price[1]) {
                    // everything is ok 
                } else {
                    unset($products[$i]);
                }
                // price filter end
            }
        }

        // remove same products
        $prev_name = '';
        for ($i = 0; $i < $product_count; $i++) {
            if ($prev_name == '') {
                $prev_name = $products[$i]->name;
            } else {
                if ($prev_name == $products[$i]->name) {
                    unset($products[$i]);
                } else {
                    $prev_name = $products[$i]->name;
                }
            }
        }

        $this->setMeta(Yii::t('app', 'Gift finder'));
        return $this->render('finder', compact('model', 'products', 'name', 'minmax', 'price'));
    }

    public function actionGetImages()
    {
        $id = Yii::$app->request->get('id');
        $position = Yii::$app->request->get('position');
        $product = Product::findOne($id);
        $images = $product->getImages();
        $imagesToAjax = [];
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
 