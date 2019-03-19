<?php 

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Product;
use app\models\GiftFinderForm;
use app\components\Navbar;

class GiftFinder extends Widget {

    public $html;
    public $minmax;
    public $model;

    public function init () {
        parent::init();
    }

    public function run () {
        // get max and min price
        $nav = new Navbar();
        $this->model = new GiftFinderForm();
        $this->minmax = [
            'min' => 0,
            'max' => 0,
        ];
        $i = 0;
        foreach ($nav->products as $product) {
            foreach ($product->prices as $price) {
                if ($i == 0) {
                    $this->minmax['min'] = $price->price;
                    $this->minmax['max'] = $price->price;
                    $i++;
                } else {
                    $price->price < $this->minmax['min'] ? $this->minmax['min'] = $price->price : $this->minmax['min'];
                    $price->price > $this->minmax['max'] ? $this->minmax['max'] = $price->price : $this->minmax['max'];
                }
            }
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