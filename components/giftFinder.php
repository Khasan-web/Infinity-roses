<?php 

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Product;

class GiftFinder extends Widget {

    public $html;
    public $minmax;

    public function init () {
        parent::init();
    }

    public function run () {
        if (Yii::$app->cache->get('minmax')) {
            $this->minmax = Yii::$app->cache->get('minmax');
        } else {
            // get max and min price
            $prods = Product::find()->all();
            $this->minmax = [
                'min' => 0,
                'max' => 0,
            ];
            foreach ($prods as $product) {
                if ($this->minmax['max']) {
                    if ($this->minmax['max'] < $product->price) {
                        $this->minmax['max'] = $product->price;
                    }
                } else {
                    $this->minmax['max'] = $product->price;
                }

                if ($this->minmax['min']) {
                    if ($this->minmax['min'] > $product->price) {
                        $this->minmax['min'] = $product->price;
                    }
                } else {
                    $this->minmax['min'] = $product->price;
                }
            }
            
            Yii::$app->cache->set('minmax', $this->minmax, 3600);
        }
        $this->html = $this->catToTemplate();
        return $this->html;
    }

    protected function catToTemplate() {
        ob_start();
        include 'giftFinder/giftFinderHtml.php';
        return ob_get_clean();
    }

}

?>