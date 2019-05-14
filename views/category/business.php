<?php

use yii\helpers\Url;

?>

<section class="business-roses section-basic pb-0">
    <div class="business p-60">
        <h2 class="prata"><?= Yii::t('app', 'Roses for business') ?></h2>
        <div class="business__description">
            <div class="col-md-6 mx-auto m-0 p-60">
                <?= $business_category->$description?>
            </div>
        </div>
        <div class="categories-row">
        <div class="categories-row__item">
            <a href="<?= Url::to('category/10') ?>">
                <img class="w-100" src="https://res.cloudinary.com/onlyro/image/upload/q_auto:eco,f_auto,c_fit,g_center,cs_srgb,b_white,w_1700,h_1700/or-2012/Roses-for-Business-2.png" alt="The Infinite Luxury Collection">
                <div class="categories-row__name">
                    <span>The Infinite Luxury Collection</span>
                </div>
            </a>
        </div>
        <div class="categories-row__item">
            <a href="<?= Url::to('category/10') ?>">
                <img class="w-100" src="https://res.cloudinary.com/onlyro/image/upload/q_auto:eco,f_auto,c_fit,g_center,cs_srgb,b_white,w_1700,h_1700/v1496310826/Doha_-_Andras_-_June_31.jpg" alt="The Classic Luxury Roses Collection">
                <div class="categories-row__name">
                    <span>The Classic Luxury Roses Collection</span>
                </div>
            </a>
        </div>
    </div>


    </div>
    </div>
    <div class="category">
        <?php 
        $i = 0;
        $count = count($business_category->category);
        foreach ($business_category->category as $cat):?>
        <a class="category__link" href="<?= Url::to(['category/view', 'id' => $cat->id])?>">
            <div class="category__title p-60">
                <h2 class="prata"><?= $cat->$name ?></h2>
            </div>
            <div class="category__example-images <?= $i != $count - 1 ? 'p-60' : ''?>">
                <img src="https://res.cloudinary.com/onlyro/image/upload/q_auto:eco,f_auto,c_fit,g_center,cs_srgb,b_white,w_1700,h_1700/v1496846671/DSC09981_crop.jpg"
                    alt="">
                <img src="https://res.cloudinary.com/onlyro/image/upload/q_auto:eco,f_auto,c_fit,g_center,cs_srgb,b_white,w_1700,h_1700/v1496846622/DSC09972_crop.jpg"
                    alt="">
                <img src="https://res.cloudinary.com/onlyro/image/upload/q_auto:eco,f_auto,c_fit,g_center,cs_srgb,b_white,w_1700,h_1700/v1496846477/DSC09967_crop.jpg"
                    alt="">
            </div>
        </a>
        <?php 
        $i++;
        endforeach;?>
    </div>
</section>