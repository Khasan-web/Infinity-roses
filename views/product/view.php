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
    <?php if (count($gallery) > 2):?>
    <i class="helper__toggle toggle fa fa-question"></i><span class="helper__label toggle px-0"></span>
    <br class="hide-on-mob">
    <div class="helper col-lg-4 col-md-12 py-0">
        <p class="m-0 mb-1"><strong><?= Yii::t('app', 'Steps to buying roses')?></strong></p>
        <ol class="pl-3">
            <li><?= Yii::t('app', 'Select a color')?></li>
            <?php if (count($product->prices) > 1) : ?>
            <li><?= Yii::t('app', 'Select a size')?></li>
            <?php endif; ?>
            <?php if ($product->vase) : ?>
            <li><?= Yii::t('app', 'If you want, you can select <span class="hide-on-mob"><br></span> an amazing vase for your fresh roses')?></li>
            <?php endif; ?>
            <?php if ($product->accessories) : ?>
            <li><?= Yii::t('app', 'For') . $product->name . Yii::t('app', 'we can offer <span class="hide-on-mob"><br></span> list of parfumes and
                chocolates')?></li>
            <?php endif;?>
            <li><?= Yii::t('app', 'Press Add to cart')?>!</li>
            <li><?= Yii::t('app', 'Click the checkout button <br> and fill out the form')?></li>
        </ol>
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <h2 class="px-2 w-100 text-center show-on-mob">
                <?= $product->name ?> <span class="subheader"><?= $product->category->$name ?></span>
            </h2>
            <div class="col-lg-6 col-md-12">

            
                <?php // getting info about main image
                $main_img_info = explode('_', $mainImage->name);
                $main_img_count = count($main_img_info);
                if ($main_img_count > 1) {
                    $main_color_name = $main_img_info[0];
                    $main_image_position = $main_img_info[1];
                    if ($main_img_count > 2) {
                        $main_image_size = $main_img_info[2];
                    }
                    $available = end($main_img_info);
                }
                // end getting info about main image ?>

                <!-- show main image -->
                <img 
                src="<?= $mainImage->getUrl('800x') ?>" 
                alt="<?= $main_color_name ?>"
                data-position="<?= $main_image_position ?>" 
                class="active-img" 
                data-color="<?= $main_color_name ?>">
                <!-- end show main image -->
                

                <!-- Positions of the roses -->
                <div class="row product__position" data-product-id="<?= $product->id ?>">


                    <?php // loop each image and then choose appropriate options for 3 position (from corner, in from, closed);
                    foreach ($gallery as $image) : ?>

                    <?php // getting data of each image
                    $img_info = explode('_', $image->name);
                    if (count($img_info) > 1) {
                        $color_name = $img_info[0];
                        $image_position = $img_info[1];
                        if (count($img_info) > 2) {
                            $size = $img_info[2];
                        }
                    }
                    ?>
                    
                    <?php // 1st position
                    if ($image_position == 1 && $image->name != 'vase'):?>
                    <div class="col-3 position" data-color="<?= $color_name?>">
                        <img 
                        data-src="<?= $image->getUrl('800x') ?>" 
                        src="<?= $image->getUrl('300x') ?>"
                        <?= count($img_info) > 2 ? 'data-size="' . $size . '"' : '' ?>
                        data-position="<?= $image_position ?>"
                        alt="<?= $image_position ?>">
                    </div>
                    <?php endif;?>

                    <?php // 2nd position
                    if ($image_position == 2 && $size == $main_image_size && $image->name != 'vase'):?>
                    <div class="col-3 position" data-color="<?= $color_name?>">
                        <img 
                        data-src="<?= $image->getUrl('800x') ?>" 
                        src="<?= $image->getUrl('300x') ?>"
                        <?= count($img_info) > 2 ? 'data-size="' . $size . '"' : '' ?>
                        data-position="<?= $image_position ?>" 
                        alt="<?= $image_position ?>">
                    </div>
                    <?php endif;?>

                <?php endforeach; // end looping ?>
                    

            
                    <?php // making another loop for closed position to make it stay like a last position
                    foreach ($gallery as $image) : ?>

                    <?php // getting image (closed position) info
                    $info = explode('_', $image->name);
                    // if there is a closed word, we make select it
                    if (in_array('closed', $info)) : ?>

                    <!-- show closed info -->
                    <div class="col-3 closed-img">
                        <img 
                        data-src="<?= $image->getUrl('800x') ?>" 
                        class="closed" 
                        src="<?= $image->getUrl('300x') ?>"
                        <?= count($img_info) > 1 ? 'data-size="' . $size . '"' : '' ?>
                        data-position="<?= $image_position ?>"
                        alt="<?= $image_position ?>">
                    </div>
                    <!-- end showing -->

                    <?php endif; ?>

                    <?php endforeach; // end image (closed position) info ?>


                </div>

                <!-- description -->
                <!-- <h2 class="text-center"><?= Yii::t('app', 'About') ?></h2>
                <div class="mx-auto description">
                    <p><?= $product->$description ?></p>
                </div> -->
                <!-- end description -->


            </div>
            <div class="col-lg-6 col-md-12 info">
                <h2 class="hide-on-mob mb-4 d-inline-block"><?= $product->name ?></h2>
                <span class="hide-on-mob subheader ml-2"><?= $product->category->$name ?></span>

                <?php // getting info about sizes
                $price = array();
                $prices = $product->prices;
                foreach ($prices as $key => $size) {
                    $price[$key] = $size['price'];
                }
                array_multisort($price, SORT_ASC, $prices);
                // end getting info about sizes ?>

                <div class="row colors">

                    <?php // show images with different colors
                    usort($gallery, function ($a, $b) {
                        return $a['name'] <=> $b['name'];
                    });
                    foreach ($gallery as $image) : ?>

                    <?php // getting info about images
                    $img_info = explode('_', $image->name);
                    $color_name = '';
                    $image_position = '';
                    if (count($img_info) > 1) {
                        $color_name = $img_info[0];
                        $image_position = $img_info[1];
                        if (count($img_info) > 2) {
                            $prod_size = $img_info[2];
                        }
                    }
                    $available = end($img_info);
                    // end getting info about images ?>

                    <!-- show images -->
                    <div class="col-3 color" data-available="<?= $available?>" title="<?= $available ? $color_name : 'Not available'?>" style="opacity: <?= $available ? '1' : '0.5'?>; cursor: <?= $available ? 'pointer' : 'no-drop'?>;">
                        <img data-src="<?= $image->getUrl('800x') ?>" src="<?= $image->getUrl('200x')?>"
                            alt="<?= $color_name ?>" data-position="<?= $image_position ?>"
                            data-color="<?= $color_name ?>"
                            style="cursor: <?= $available ? 'pointer' : 'no-drop'?>;"
                            <?= count($img_info) > 2 ? 'data-size="' . $prod_size . '"' : '' ?>>
                        <span><?= ucfirst($color_name) ?></span>
                    </div>
                    <!-- end show images -->

                    <?php endforeach; // show images with different colors ?>

                </div>
                <hr>
                <div class="row my-4 info-panel">
                    <div class="col-5">
                        <h3 class="mb-0 product__price"><?= Yii::t('app', 'Price') ?></h3>
                    </div>
                    <div class="col-7 size">
                        <select class="custom-select d-inline" id="product__size">

                            <?php // getting sizes of a product
                            $i = 0;
                            foreach ($prices as $size) : ?>
                            <?php if ($i = 0) : ?>
                            <option selected data-price="<?= $size->price ?>" data-width="<?= $size->width ?>"
                                data-height="<?= $size->height ?>" value="<?= $size->size ?>"><?= $size->$size_name ? ucfirst($size->$size_name) : $size->size ?>
                            </option>
                            <?php endif; ?>
                            <option data-price="<?= $size->price ?>" data-width="<?= $size->width ?>"
                                data-height="<?= $size->height ?>" value="<?= $size->size ?>">
                                <?= $size->$size_name ? ucfirst($size->$size_name) : $size->size?></option>
                            <?php endforeach; // end etting sizes of a product ?>

                        </select>
                        <?php // show height and width of a size
                        if ($prices[0]->width) : ?>
                        <span class="width_height"><?= Yii::t('app', 'Height') ?>: <span
                                class="height">--</span><?= Yii::t('app', 'cm'); ?> | <?= Yii::t('app', 'Width') ?>:
                            <span class="width">--</span><?= Yii::t('app', 'cm'); ?></span>
                        <?php endif; // end showing ?>
                    </div>

                    <!-- share buttons -->
                    <div class="col-md-5 col-12 share-buttons hide-on-mob pr-0">
                        <span><?= Yii::t('app', 'Share') ?> <?= $product->name ?></span>
                        <div class="ya-share2" data-services="facebook,whatsapp,twitter,telegram"></div>
                    </div>
                    <div class="col-lg-7 col-md-12 text-center">
                        <button class="btn btn-dark add-to-cart btn-block mt-2" data-id="<?= $product->id ?>"><i
                                class="fas fa-shopping-cart mr-1"></i> <?= Yii::t('app', 'Add to cart!') ?></button>
                    </div>
                    <div class="col-lg-5 col-md-12 share-buttons show-on-mob mt-3">
                        <span><?= Yii::t('app', 'Share') ?> <?= $product->name ?></span>
                        <div class="ya-share2" data-services="facebook,whatsapp,twitter,telegram"></div>
                    </div>
                    <!-- end share buttons -->


                </div>
                <?php // showing a vase
                if ($product->vase) : ?>

                <?php // getting a vase
                foreach ($gallery as $image) {
                    if ($image->name == 'vase') {
                        $vase = $image;
                    }
                }
                // end getting a vase ?>

                <!-- show a vase -->
                <hr>
                <div class="vase dark-elements my-4">
                    <div class="checkbox">
                        <div class="custom-control d-inline custom-checkbox mx-2">
                            <img src="<?= $vase->getUrl('80x') ?>" style="width: 80px" alt="vase">
                            <input type="checkbox" class="custom-control-input vase">
                            <label class="custom-control-label" for="customSwitches">Vase</label>
                        </div>
                        <p class="mt-1 text-center"><span class="vase-price"><?= $product->vase ?></span> sum</p>
                    </div>
                    <div>
                        <p class="tip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe fugiat eaque
                            quaerat</p>
                    </div>
                </div>

                <?php endif; // end showing a vase ?>


                <?php // showing parfume and chocalate
                if ($product->accessories) : ?>
                <hr>
                <div class="row my-4">
                    <div class="col-6">
                        <button
                            class="btn btn-outline-dark w-100 toggle-parfume mb-1"><?= Yii::t('app', 'Parfume') ?></button>
                    </div>
                    <div class="col-6 mb-4">
                        <button
                            class="btn btn-outline-dark w-100 toggle-chocolate mb-1"><?= Yii::t('app', 'Chocolate') ?></button>
                    </div>
                </div>
                <div class="owl-carousel owl-theme parfume-carousel">
                    <div data-id="1">
                        <img src="img/product/parfume.jpg" alt="">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div data-id="2">
                        <img src="img/product/parfume.jpg" alt="">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div data-id="3">
                        <img src="img/product/parfume.jpg" alt="">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div data-id="4">
                        <img src="img/product/parfume.jpg" alt="">
                        <i class="fas fa-circle"></i>
                    </div>
                </div>

                <div class="cancel-accessory">
                    <button class="btn btn-outline-dark cancel-parfume px-3 py-1 mb-4">Cancel parfume</button>
                </div>

                <div class="owl-carousel owl-theme chocolate-carousel">
                    <div data-id="1">
                        <img src="img/product/chocalte.png" alt="">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div data-id="2">
                        <img src="img/product/chocalte.png" alt="">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div data-id="3">
                        <img src="img/product/chocalte.png" alt="">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div data-id="4">
                        <img src="img/product/chocalte.png" alt="">
                        <i class="fas fa-circle"></i>
                    </div>
                </div>

                <div class="cancel-accessory">
                    <button class="btn btn-outline-dark cancel-chocolate px-3 py-1 mb-4">Cancel chocolate</button>
                </div>

                <p class="mx-3">
                    <?= Yii::t('app', 'Firstly bla bla bla Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate eius ducimus molestias est, temporibus quia.') ?>
                </p>
                <?php else : ?>
                <hr>
                <?php endif; // end showing parfume and chocalate ?>
            </div>
        </div>
    </div>
</section>


<?php // showing hits
if ($hits) : ?>
<section id="popular-prods">
    <p class="subheader text-black text-uppercase"><?= Yii::t('app', 'Most choice') ?></p>
    <h2 class="prata fsize_h1"><?= Yii::t('app', 'Popular Roses') ?></h2>
    <div class="container">
        <div class="row mt-5">

            <?php // delay to make fade effect
            $delay = 0.6;?>

            <?php // looping hits array
            foreach ($hits as $hit) : ?>
            <?php if ($hit->hit) : ?>
            <?php
            $delay += 0.2;
            $image = $hit->getImage();
            ?>
            <div class="col-lg-3 col-6 product wow fadeIn" data-wow-delay="<?= $delay ?>s">
                <a href="<?= Url::to(['product/view', 'id' => $hit->id]) ?>">
                    <img src="<?= $image->getUrl() ?>" alt="" class="w-100" />
                    <h2 class="name"><?= $hit->name ?></h2>
                </a>
                <p class="price"><?= $hit->category->$name ?></p>
            </div>
            <?php endif; ?>
            <?php endforeach; //end looping ?>
        </div>
    </div>
</section>
<?php endif; // end shoing ?>