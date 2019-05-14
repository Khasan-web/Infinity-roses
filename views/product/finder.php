<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;


function checkGetParam($param)
{
    return isset($_GET[$param]) || isset($_GET['GiftFinderForm'][$param]) ? true : false;
}

?>

<section id="finder-page" class="dark-elements">
    <h2 class="prata fsize_h1 text-center"><?= Yii::t('app', 'Gift Finder') ?></h2>
    <form action="<?= Url::to(['product/gift-finder']) ?>">
        <div class="container mt-5">
            <div class="row mx-auto my-4">
                <div class="col-md-2 col-12">
                    <h3><?= Yii::t('app', 'For:') ?></h3>
                </div>
                <div class="col-md-2 col-12 mx-auto">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="event" class="custom-control-input" <?= Yii::$app->request->get('event') || Yii::$app->request->get('GiftFinderForm')['event'] ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', "Valentine's") ?></label>
                    </div>
                </div>
                <div class="col-md-2 col-12 mx-auto">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="her" class="custom-control-input" <?= Yii::$app->request->get('her') || Yii::$app->request->get('GiftFinderForm')['her'] ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Her') ?></label>
                    </div>
                </div>
                <div class="col-md-2 col-12 mx-auto">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="him" class="custom-control-input" <?= Yii::$app->request->get('him') || Yii::$app->request->get('GiftFinderForm')['him'] ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Him') ?></label>
                    </div>
                </div>
                <div class="col-md-2 col-12 mx-auto">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="home" class="custom-control-input" <?= Yii::$app->request->get('home') || Yii::$app->request->get('GiftFinderForm')['home'] ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Home') ?></label>
                    </div>
                </div>
            </div>
            <div class="row mx-auto my-4">
                <div class="col-md-2 col-12">
                    <h3><?= Yii::t('app', 'Rose type:') ?></h3>
                </div>
                <div class="col-md-2 col-12 mx-auto">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="fresh" class="custom-control-input" <?= Yii::$app->request->get('fresh') || Yii::$app->request->get('GiftFinderForm')['fresh'] ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Fresh ( Classic )') ?></label>
                    </div>
                </div>
                <div class="col-md-3 col-12 mx-auto">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="infinity" class="custom-control-input" <?= Yii::$app->request->get('infinity') || Yii::$app->request->get('GiftFinderForm')['infinity'] ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Long lasting roses ( Infinity )') ?></label>
                    </div>
                </div>
                <!-- offset -->
                <div class="col-md-1 col-0 mx-auto"></div>
                <div class="col-md-2 col-0 mx-auto"></div>
                <!-- end offset -->
            </div>
            <div class="row mx-auto my-4">
                <div class="col-md-2 col-12">
                    <h3><?= Yii::t('app', 'Price:') ?></h3>
                </div>
                <div class="col-md-9 col-12 mx-auto px-4 p-md-0">
                    <div id="gift-finder-page" class="slider-range" data-min="<?= $minmax['min'] ?>" data-max="<?= $minmax['max'] ?>"></div>
                    <input id="gf-price" class="sr-only" type="text" name="price">
                        <!-- showing current price diapazon -->
                        <div class="slider__values text-center mx-auto" id="slider-range-value">
                            <?= Yii::t('app', 'from')?> <span class="slider__min"><?= priceWithSpaces($minmax['min']) ?></span> <?= Yii::t('app', 'sum') ?> 
                            &nbsp &nbsp<?= Yii::t('app', 'to')?> <span class="slider__max"><?= priceWithSpaces($minmax['max']) ?></span> <?= Yii::t('app', 'sum') ?>
                        </div>
                        <!-- min price from assortiment and max -->
                        <div class="row mt-1">
                            <div class="col-6 text-left pl-1">
                                <span class="price min"><?= priceWithSpaces($minmax['min']) ?> <?= Yii::t('app', 'sum') ?></span>
                            </div>
                            <div class="col-6 text-right pr-1">
                                <span class="price max"><?= priceWithSpaces($minmax['max']) ?> <?= Yii::t('app', 'sum') ?></span>
                            </div>
                        </div>
                </div>
            </div>
            <div class="my-4 text-center">
                <button class="btn btn-outline-dark gf-submit" type="submit"><?= Yii::t('app', 'Find Roses!') ?></button>
            </div>
        </div>
    </form>

    <hr>

    <div class="text-center container">
        <?php if ($products) : ?>
            <div class="row mt-5">
                <?php foreach ($products as $product) : ?>
                    <?php $image = $product->getImage() ?>
                    <div class="col-lg-3 col-6 product wow fadeIn" data-wow-delay="0.6s">
                        <a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>">
                            <img src="<?= $image->getUrl() ?>" alt="" class="w-100" />
                            <h2 class="name"><?= $product->name ?></h2>
                        </a>
                        <p class="price"><?= $product->category->$name ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <h2 class="not-found"><?= Yii::t('app', 'Nothing is found...'); ?></h2>
        <?php endif; ?>
    </div>

</section>