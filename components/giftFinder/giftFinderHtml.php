<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\GiftFinder;
use app\models\GiftFinderForm;
use yii\helpers\Html;

$get_price = Yii::$app->request->get('price');
if ($get_price) {
    $price = explode(',', $get_price);
} else {
    $get_price = Yii::$app->request->get('GiftFinderForm')['price'];
    if ($get_price) {
        $price = explode(',', Yii::$app->request->get('GiftFinderForm')['price']);
    } else {
        $price = false;
    }
}

// active class in navbar
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');


?>

<form action="<?= Url::to(['product/gift-finder'])?>">
    <li class="nav-item drop-item <?= $controller == 'product' && $action == 'gift-finder' ? 'active' : ''?>"
        role="button" id="gift-finder-item" aria-haspopup="true" aria-expanded="false">
        <a class="nav-link" href="<?= Url::to(['product/gift-finder'])?>"><?= Yii::t('app', 'Gift Finder')?></a>
        <div class="dropdown-menu" id="finder" aria-labelledby="gift-finder-item">
            <div class="container">
                <div class="row mx-auto my-4">
                    <div class="col-md-2 col-3">
                        <h3><?= Yii::t('app', 'For:')?></h3>
                    </div>
                    <div class="col-md-2 col-3 mx-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="event" class="custom-control-input"
                                <?= Yii::$app->request->get('event') || Yii::$app->request->get('GiftFinderForm')['event'] ? 'checked' : ''?>>
                            <label class="custom-control-label"
                                for="customSwitches"><?= Yii::t('app', "Valentine's")?></label>
                        </div>
                    </div>
                    <div class="col-md-2 col-3 mx-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="her" class="custom-control-input"
                                <?= Yii::$app->request->get('her') || Yii::$app->request->get('GiftFinderForm')['her'] ? 'checked' : ''?>>
                            <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Her')?></label>
                        </div>
                    </div>
                    <div class="col-md-2 col-3 mx-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="him" class="custom-control-input"
                                <?= Yii::$app->request->get('him') || Yii::$app->request->get('GiftFinderForm')['him'] ? 'checked' : ''?>>
                            <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Him')?></label>
                        </div>
                    </div>
                    <div class="col-md-2 col-3 mx-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="home" class="custom-control-input"
                                <?= Yii::$app->request->get('home') || Yii::$app->request->get('GiftFinderForm')['home'] ? 'checked' : ''?>>
                            <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Home')?></label>
                        </div>
                    </div>
                </div>
                <div class="row mx-auto my-4">
                    <div class="col-md-2 col-3">
                        <h3><?= Yii::t('app', 'Rose type:')?></h3>
                    </div>
                    <div class="col-md-2 col-3 mx-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="fresh" class="custom-control-input"
                                <?= Yii::$app->request->get('fresh') || Yii::$app->request->get('GiftFinderForm')['fresh'] ? 'checked' : ''?>>
                            <label class="custom-control-label"
                                for="customSwitches"><?= Yii::t('app', 'Fresh ( Classic )')?></label>
                        </div>
                    </div>
                    <div class="col-md-3 col-3 mx-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="infinity" class="custom-control-input"
                                <?= Yii::$app->request->get('infinity') || Yii::$app->request->get('GiftFinderForm')['infinity'] ? 'checked' : ''?>>
                            <label class="custom-control-label"
                                for="customSwitches"><?= Yii::t('app', 'Long lasting roses ( Infinity )')?></label>
                        </div>
                    </div>
                    <!-- offset -->
                    <div class="col-md-1 col-0 mx-auto"></div>
                    <div class="col-md-2 col-0 mx-auto"></div>
                    <!-- end offset -->
                </div>
                <div class="row mx-auto my-4">
                    <div class="col-md-2 col-3">
                        <h3><?= Yii::t('app', 'Price:')?></h3>
                    </div>
                    <div class="col-md-9 col-12 mx-auto p-0">
                        <input type="text" name="price" data-slider-tooltip="show" value="<?php
                if ($price[0] && $price[1]) {
                    echo $price[0] . ',' . $price[1];
                } else {
                    echo $this->minmax['min'] . ',' . $this->minmax['max'];
                }
             ?>" data-slider-min="<?= $this->minmax['min']?>" data-slider-max="<?= $this->minmax['max']?>"
                            data-slider-step="5" data-slider-value="[<?php
                if ($price[0] && $price[1]) {
                    echo $price[0] . ',' . $price[1];
                } else {
                    echo $this->minmax['min'] . ',' . $this->minmax['max'];
                }
             ?>]" class="custom-control-input" id="gift-finder">
                        <!-- complete showing current price diapazon -->
                        <div class="row">
                            <div class="col-6 text-left pl-1">
                                <span class="price min"><?= $this->minmax['min']?> <?= Yii::t('app', 'sum')?></span>
                            </div>
                            <div class="col-6 text-right pr-1">
                                <span class="price max"><?= $this->minmax['max']?> <?= Yii::t('app', 'sum')?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-4 text-center">
                    <button class="btn btn-outline-gold" type="submit"><?= Yii::t('app', 'Find Roses!')?></button>
                </div>
            </div>
        </div>
    </li>
</form>