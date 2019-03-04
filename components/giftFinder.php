<?php 

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\GiftFinderForm;

class GiftFinder extends Widget {

    public $html;
    public $model;

    public function init () {
        parent::init();
    }

    public function run () {
        $this->html = $this->catToTemplate();
        $this->model = new GiftFinderForm();
        return $this->html;
    }

    protected function catToTemplate() {
        ob_start();
        include '/giftFinder/giftFinderHtml.php';
        return ob_get_clean();
    }

}

?>