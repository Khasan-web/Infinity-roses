<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<section id="about-company">
    <h2 class="prata fsize_h1"><?= Yii::t('app', 'About Infinity roses')?></h2>
    <div class="line gold-bg my-3"></div>
    <div class="col-lg-4 col-md-5 mx-auto">
        <p><?= Yii::t('app', 'Infinity roses - these are real roses, which are stored without water for more than 3 years! Exclusive floristic brand Infinity Roses embodies the true connoisseurs of beauty and rethinks the art of luxury gifts. Infinity roses can not be the same as those of several owners! The infinity of roses - is 30 unique colors, ranging from natural, to the most amazing, such as black, gold, lavender and other unique shades. Such a color palette is satisfactory even for the most demanding connoisseurs of the floral world.')?>
        </p>
    </div>
    <div class="vline my-5"></div>
    <h2><?= Yii::t('app', 'What Do We Offer')?>:</h2>
    <div class="line gold-bg my-3"></div>
    <div class="col-lg-4 col-md-5 mx-auto">
        <p class="text-center"><?= Yii::t('app', 'Infinity Roses provides various rose compositions in three categories: Infinite Roses, Classic Roses, Luxury Collection')?></p>
    </div>
    <div class="categories-row">
        <div class="categories-row__item">
            <a class="categories-row__link" href="<?= Url::to('category/1')?>">
                <img class="h-100" src="img/category/infinite-roses.jpg" alt="Category">
                <div class="categories-row__name">
                    <span><?= Yii::t('app', 'Infinite Roses')?></span>
                </div>
            </a>
        </div>
        <div class="categories-row__item">
            <a class="categories-row__link" href="<?= Url::to('category/2')?>">
                <img class="h-100" src="img/category/fresh-roses.jpg" alt="Category">
                <div class="categories-row__name">
                    <span><?= Yii::t('app', 'Classic Roses')?></span>
                </div>
            </a>
        </div>
        <div class="categories-row__item">
            <a class="categories-row__link" href="<?= Url::to('category/3')?>">
                <img class="h-100" src="img/category/luxury-collection.jpg" alt="Category">
                <div class="categories-row__name">
                    <span><?= Yii::t('app', 'Luxury Collection')?></span>
                </div>
            </a>
        </div>
    </div>
</section>