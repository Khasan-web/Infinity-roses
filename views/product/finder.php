<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;


function checkGetParam($param) {
    return isset($_GET[$param]) || isset($_GET['GiftFinderForm'][$param]) ? true : false;
}

?>

<section id="finder-page" class="dark-elements">
    <h1><?= Yii::t('app', 'Gift Finder')?></h1>
    <form action="<?= Url::to(['product/gift-finder'])?>">
        <div class="container mt-5">
            <div class="row mx-auto my-4">
                <div class="col-md-2 col-3">
                    <h3><?= Yii::t('app', 'For:')?></h3>
                </div>
                <div class="col-md-2 col-3 mx-auto">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="event" class="custom-control-input"
                            <?= Yii::$app->request->get('event') || Yii::$app->request->get('GiftFinderForm')['event'] ? 'checked' : ''?>>
                        <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', "Valentine's")?></label>
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
                        echo $minmax['min'] . ',' . $minmax['max'];
                    }
                ?>" 
                data-slider-min="<?= $minmax['min']?>" 
                data-slider-max="<?= $minmax['max']?>"
                data-slider-step="5" 
                data-slider-value="[<?php
                    if ($price[0] && $price[1]) {
                        echo $price[0] . ',' . $price[1];
                    } else {
                        echo $minmax['min'] . ',' . $minmax['max'];
                    }
                ?>]" 
                class="custom-control-input" 
                id="gift-finder-page">
                    <!-- complete showing current price diapazon -->
                    <div class="row">
                        <div class="col-6 text-left pl-1">
                            <span class="price min"><?= $minmax['min']?> <?= Yii::t('app', 'sum')?></span>
                        </div>
                        <div class="col-6 text-right pr-1">
                            <span class="price max"><?= $minmax['max']?> <?= Yii::t('app', 'sum')?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-4 text-center">
                <button class="btn btn-outline-dark" type="submit"><?= Yii::t('app', 'Find Roses!')?></button>
            </div>
        </div>
    </form>
    
    <hr>

    <div class="text-center container">
        <?php if ($products): ?>
        <div class="row mt-5">
            <?php foreach ($products as $product): ?>
            <?php $image = $product->getImage()?>
            <div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="0.6s">
                <a href="<?= Url::to(['product/view', 'id' => $product->id])?>">
                    <img src="<?= $image->getUrl()?>" alt="" class="w-100" />
                    <h2 class="name"><?= $product->name?></h2>
                </a>
                <p class="price"><?= $product->category->$name?></p>
            </div>
            <?php endforeach;?>
        </div>
        <?php else:?>
        <h2 class="not-found"><?= Yii::t('app', 'Nothing is found...');?></h2>
        <?php endif;?>
    </div>

</section>