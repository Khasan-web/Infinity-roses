<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use yii\web\HttpException;
use app\models\GiftFinderForm;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use app\models\Category;
use app\models\Gallery;
use app\models\Color;
use app\models\Events;

class ProductController extends AppController
{

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $name = getLang('name');
        $product = Product::findOne($id);
        $size_name = Yii::$app->language == 'ru' ? 'size_ru' : 'size';
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
        $img = $product->getImage();
        $social_img = Url::base(true) . $img->getUrl('850x');
        $this->setMeta($product->name, $product->keywords, null, $social_img);
        return $this->render('view', compact('product', 'hits', 'lang', 'name', 'size_name'));
    }

    public function actionGiftFinder()
    {
        $model = new GiftFinderForm();
        $name = 'name_' . Yii::$app->language;
        $request = Yii::$app->request;

        // get the event
        $events = Events::find()->asArray()->all();
        $giftFinder_event = '';
        foreach ($events as $event) {
            $keys_explode = explode(' ', $event['keywords']);
            foreach ($keys_explode as $key) {
                if ($key == 'gift-finder') {
                    $giftFinder_event = $event[$name];
                }
            }
        }

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
                // $key_existing = strpos($product->keywords, $key);
                $keys_arr = explode(' ', $product->keywords);
                foreach ($keys_arr as $keyword) {
                    if ($keyword == $key) {
                        return true;
                    }
                }
                // return $key_existing ? true : false;
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
                $selected_type = 'Infinite Roses';
            }

            // fresh
            if ($fresh) {
                $selected_type = 'Fresh Roses';
            }

            // both
            if ($infinity and $fresh) {
                $selected_type = false;
            }

            // check if switched filter is one and it is Infinite Roses filter
            if (count($request->get()) == 2 && isset($_GET['infinity'])) {
                if ($prods[$i]->category->name_en == 'Infinite Roses') {
                    array_push($products, $prods[$i]);
                }
            }

            // check if switched filter is one and it is fresh roses filter
            if (count($request->get()) == 2 && isset($_GET['fresh'])) {
                if ($prods[$i]->category->name_en == 'Fresh Roses') {
                    array_push($products, $prods[$i]);
                }
            }

            // check if switched filters are fresh roses filter and Infinite Roses filter
            if (count($request->get()) == 3 && isset($_GET['infinity']) && isset($_GET['fresh'])) {
                if ($prods[$i]->category->name_en == 'Infinite Roses') {
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

        if (count($request->get()) == 1 && $request->get('price')) {
            if ($price[0] != $minmax['min'] || $price[1] != $minmax['max']) {
                $products = $prods;
                for ($i = 0; $i < $product_count_prods; $i++) {
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
            $product_count = count($products);
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

        $this->setMeta(Yii::t('app', 'Gift Finder'), 'gift finder roses beautiful tashkent поиск подарков красивый розы ташкент', Yii::t('app', 'Gift finder is a filter that helps you find the most suitable composition of roses for a gift, and Gift finder can be used as a more convenient version of the search for roses among the assortment of Infinity Roses!'));
        return $this->render('finder', compact('model', 'products', 'name', 'minmax', 'price', 'giftFinder_event'));
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


    public function actionGallery() {
        $categories = Category::find()->asArray()->all();
        $name = getLang('name');
        $gallery = Gallery::find()->all();
        $this->setMeta('Gallery', 'gallery infinity roses infinityroses flowers beautiful', 'See the amazing gallery of Infinityroses');
        return $this->render('gallery', compact('categories', 'name', 'gallery'));
    }

}
 