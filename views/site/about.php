<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<section id="about-company">
    <h1><?= Yii::t('app', 'About Infinity roses')?></h1>
    <div class="col-lg-3 col-md-5 mx-auto">
        <p><?= Yii::t('app', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis dolores atque dolorem alias autem distinctio.')?></p>
    </div>
    <div class="vline my-5"></div>
    <h2><?= Yii::t('app', 'Who Are We')?>?</h2>
    <div class="line gold-bg my-3"></div>
    <div class="col-lg-3 col-md-5 mx-auto">
        <p><?= Yii::t('app', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis dolores atque dolorem alias autem distinctio. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis rerum beatae modi ad asperiores. Nobis!')?></p>
    </div>
    <div class="vline my-5"></div>
    <h2><?= Yii::t('app', 'What Do We Offer')?>?</h2>
    <div class="line gold-bg my-3"></div>
    <div class="col-lg-3 col-md-5 mx-auto">
        <p><?= Yii::t('app', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis dolores atque dolorem alias autem distinctio. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis rerum beatae modi ad asperiores. Nobis!')?></p>
    </div>
    <div class="vline my-5"></div>
    <h2><?= Yii::t('app', 'First In Uzbekistan')?></h2>
    <div class="line gold-bg my-3"></div>
    <div class="col-lg-3 col-md-5 mx-auto">
        <p><?= Yii::t('app', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis dolores atque dolorem alias autem distinctio. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis rerum beatae modi ad asperiores. Nobis!')?></p>
    </div>
    <a href="<?= Url::to(['/'])?>" class="btn btn-outline-dark mt-5"><?= Yii::t('app', 'Main page')?></a>
</section>
