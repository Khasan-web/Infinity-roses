<?php

use yii\helpers\Url;

$_GET['active-category'] = $product->category->id;

?>
<?php
	$mainImage = $product->getImage();
    $gallery = $product->getImages();
    $description = 'description_' . Yii::$app->language;
?>
<section id="product-details">
<i class="helper__toggle toggle fa fa-question"></i><span class="helper__label toggle px-0">How to buy?</span>
<br class="hide-on-mob">
    <div class="helper col-lg-4 col-md-12 py-0">
        <p class="m-0 mb-1"><strong>Steps to buys roses</strong></p>
        <ol class="pl-3">
            <li>Select a color</li>
            <li>Select a size</li>
            <li>if the product is bouquet, you can <br class="hide-on-mob"> select a vase</li>
            <li>Press Add to cart!</li>
        </ol>
    </div>
    <div class="container">
        <div class="row">
            <h2 class="px-2 w-100 text-center show-on-mob">
                <?= $product->name?> <span class="subheader"><?= $product->category->$name?></span>
            </h2>
            <div class="col-lg-6 col-md-12">
                <?php
                    $img_info = explode('_' , $mainImage->name);
                    $main_color_name = $img_info[0];
                    $main_image_position = $img_info[1];
                ?>
                <img src="<?= $mainImage->getUrl()?>" alt="<?= $main_color_name?>"
                    data-position="<?= $main_image_position?>" class="active-img" data-color="<?= $main_color_name?>">
                <div class="row product__position" data-product-id="<?= $product->id?>">
                    <?php foreach ($gallery as $image):?>
                    <?php
                        $img_info = explode('_', $image->name);
                        $color_name = '';
                        $image_position = '';
                        $color_name = $img_info[0];
                        $image_position = $img_info[1];
                        $size = $img_info[2];
                    ?>
                    <?php if ($image_position == 1 && $color_name == 'red'):?>
                    <div class="col-3">
                        <img class="active-img__image" data-src="<?= $image->getUrl()?>"
                            src="<?= $image->getUrl('300x')?>" data-size="<?= $size?>"
                            data-position="<?= $image_position?>" alt="<?= $image_position?>">
                    </div>
                    <?php endif;?>
                    <?php if ($image_position == 2 && $color_name == 'red'):?>
                    <div class="col-3">
                        <img data-src="<?= $image->getUrl()?>" src="<?= $image->getUrl('300x')?>"
                            data-size="<?= $size?>" data-position="<?= $image_position?>" alt="<?= $image_position?>">
                    </div>
                    <?php endif;?>
                    <?php if ($image_position == 3):?>
                    <div class="col-3">
                        <img data-src="<?= $image->getUrl()?>" class="closed" src="<?= $image->getUrl('300x')?>"
                            data-size="<?= $size?>" data-position="<?= $image_position?>" alt="<?= $image_position?>">
                    </div>
                    <?php endif;?>
                    <?php endforeach;?>

                </div>
                <h2 class="text-center"><?= Yii::t('app', 'About')?></h2>
                <div class="mx-auto description">
                    <p><?= $product->$description?></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 info">
                <h2 class="hide-on-mob mb-4 d-inline-block"><?= $product->name?></h2>
                <span class="hide-on-mob subheader ml-2"><?= $product->category->$name?></span>
                <?php
                    $price = array();
                    $prices = $product->prices;
                    foreach ($prices as $key => $size)
                    {
                        $price[$key] = $size['price'];
                    }
                    array_multisort($price, SORT_ASC, $prices);
                ?>
                <div class="row colors">
                    <?php foreach ($gallery as $image):?>
                    <?php
                        $img_info = explode('_', $image->name);
                        $color_name = '';
                        $image_position = '';
                        $color_name = $img_info[0];
                        $image_position = $img_info[1];
                        $size = $img_info[2];
                    ?>
                    <div class="col-3 color">
                        <img data-src="<?= $image->getUrl()?>" src="<?= $image->getUrl('200x')?>"
                            alt="<?= $color_name?>" data-position="<?= $image_position?>" data-color="<?= $color_name?>"
                            data-size="<?= $size?>">
                        <span><?= $color_name?></span>
                    </div>
                    <?php endforeach;?>
                </div>
                <hr>
                <div class="row my-4 info-panel">
                    <div class="col-lg-4 col-md-4 col-4">
                        <h3 class="mb-0 product__price"><?= Yii::t('app', 'Price')?></h3>
                    </div>
                    <div class="col-lg-4 col-md-4 col-8 size">
                        <select class="custom-select d-inline">
                            <?php $i = 0; foreach ($prices as $size):?>
                            <?php if ($i = 0):?>
                            <option selected data-price="<?= $size->price?>" data-width="<?= $size->width?>"
                                data-height="<?= $size->height?>" value="<?= $size->size?>"><?= $size->size?></option>
                            <?php endif;?>
                            <option data-price="<?= $size->price?>" data-width="<?= $size->width?>"
                                data-height="<?= $size->height?>" value="<?= $size->size?>"><?= $size->size?></option>
                            <?php endforeach;?>
                        </select>
                        <?php if ($prices[0]->width):?>
                        <span class="width_height">H: <span class="height">--</span><?= Yii::t('app', 'cm');?> | W:
                            <span class="width">--</span><?= Yii::t('app', 'cm');?></span>
                        <?php endif;?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 text-center">
                        <button class="btn btn-dark add-to-cart btn-block"
                            data-id="<?= $product->id?>"><?= Yii::t('app', 'Add to cart!')?></button>
                    </div>
                </div>
                <?php if ($product->vase):?>
                <hr>
                <?php
                        foreach ($gallery as $image) {
                            if ($image->name == 'vase') {
                                $vase = $image;
                            }
                        }
                    ?>
                <div class="vase dark-elements my-4">
                    <div>
                        <img src="<?= $vase->getUrl('80x')?>" style="width: 80px" alt="">
                    </div>
                    <div>
                        <div class="custom-control d-inline custom-checkbox mx-2">
                            <input type="checkbox" value="false" class="custom-control-input vase">
                            <label class="custom-control-label" for="customSwitches">Vase</label>
                        </div>
                        <span class="mt-1 mx-1 d-block"><?= $product->vase?> sum</span>
                    </div>
                    <div>
                        <p class="tip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe fugiat eaque
                            quaerat</p>
                    </div>
                </div>
                <?php endif;?>
                <?php if ($product->accessories):?>
                <hr>
                <div class="row my-4">
                    <div class="col-md-6">
                        <button
                            class="btn btn-outline-dark w-100 toggle-parfume mb-1"><?= Yii::t('app', 'Parfume')?></button>
                    </div>
                    <div class="col-md-6 mb-4">
                        <button
                            class="btn btn-outline-dark w-100 toggle-chocolate mb-1"><?= Yii::t('app', 'Chocolate')?></button>
                    </div>
                </div>
                <div class="owl-carousel owl-theme parfume-carousel">
                    <div data-id="1"><img src="img/product/parfume.jpg" alt=""></div>
                    <div data-id="2"><img src="img/product/parfume.jpg" alt=""></div>
                    <div data-id="3"><img src="img/product/parfume.jpg" alt=""></div>
                    <div data-id="4"><img src="img/product/parfume.jpg" alt=""></div>
                </div>
                <div class="owl-carousel owl-theme chocolate-carousel">
                    <div data-id="1"><img src="img/product/chocalte.png" alt=""></div>
                    <div data-id="2"><img src="img/product/chocalte.png" alt=""></div>
                    <div data-id="3"><img src="img/product/chocalte.png" alt=""></div>
                    <div data-id="4"><img src="img/product/chocalte.png" alt=""></div>
                </div>
                <p class="mx-3">
                    <?= Yii::t('app', 'Firstly bla bla bla Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate eius ducimus molestias est, temporibus quia.')?>
                </p>
                <?php else:?>
                <hr>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>
<?php if ($hits):?>
<section id="popular-prods">
    <p class="subheader text-black"><?= Yii::t('app', 'MOST CHOICE')?></p>
    <h1><?= Yii::t('app', 'Popular roses')?></h1>
    <div class="container">
        <div class="row mt-5">
            <?php
                $delay = 0.6;
            ?>
            <?php foreach ($hits as $hit):?>
            <?php if ($hit->hit):?>
            <?php 
                $delay += 0.2;
                $image = $hit->getImage();
            ?>
            <div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="<?= $delay?>s">
                <a href="<?= Url::to(['product/view', 'id' => $hit->id])?>">
                    <img src="<?= $image->getUrl()?>" alt="" class="w-100" />
                    <h2 class="name"><?= $hit->name?></h2>
                </a>
                <p class="price"><?= $hit->category->$name?></p>
            </div>
            <?php endif;?>
            <?php endforeach;?>
        </div>
    </div>
</section>
<?php endif;?>