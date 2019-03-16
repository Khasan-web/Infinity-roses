<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\GiftFinder;
use app\models\GiftFinderForm;
use yii\helpers\Html;

?>

<form action="<?= Url::to(['product/gift-finder'])?>">
<li class="nav-item drop-item" role="button" id="gift-finder-item" aria-haspopup="true" aria-expanded="false">
    <a class="nav-link" href="<?= Url::to(['site/contact'])?>"><?= Yii::t('app', 'Gift Finder')?></a>
    <div class="dropdown-menu" id="finder" aria-labelledby="gift-finder-item">
        <div class="container">
        <div class="row mx-auto my-4">
            <div class="col-md-2 col-3">
            <h3><?= Yii::t('app', 'For:')?></h3>
            </div>
            <div class="col-md-2 col-3 mx-auto">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="event" class="custom-control-input">
                <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', "Valentine's")?></label>
            </div>
            </div>
            <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                <input type="checkbox" name="event" class="custom-control-input">
                    <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Her')?></label>
                </div>
            </div>
            <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="event" class="custom-control-input">
                    <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Him')?></label>
                </div>
            </div>
            <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="event" class="custom-control-input">
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
                <!-- <input type="checkbox" class="custom-control-input" id="him" /> -->
                <input type="checkbox" name="event" class="custom-control-input">
                <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Fresh ( Classic )')?></label>
            </div>
            </div>
            <div class="col-md-3 col-3 mx-auto">
            <div class="custom-control custom-switch">
                <!-- <input type="checkbox" class="custom-control-input" id="home" /> -->
                <input type="checkbox" name="event" class="custom-control-input">
                <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Long lasting roses ( Infinity )')?></label>
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
            <input type="text" 
            name="price" 
            value="[<?= $this->minmax['min'] . ',' . $this->minmax['max']?>]" 
            data-slider-tooltip="show" 
            data-slider-min="<?= $this->minmax['min']?>" 
            data-slider-max="<?= $this->minmax['max']?>" 
            data-slider-step="5" 
            data-slider-value="[<?= $this->minmax['min'] . ',' . $this->minmax['max']?>]" 
            class="custom-control-input" 
            id="gift-finder">
            <div class="row">
                <div class="col-6 text-left pl-1">
                <span class="price min">$<?= $this->minmax['min']?></span>
                </div>
                <div class="col-6 text-right pr-1">
                <span class="price max">$<?= $this->minmax['max']?></span>
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