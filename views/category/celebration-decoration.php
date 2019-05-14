<?php

use yii\helpers\Url;

$mainImage = $category->getImage();
$desc_arr = explode('<p>divide</p>', $category->$description);

?>

<section id="cat" class="section-basic pt-0">

    <div class="event-img text-center" style="background-image: url(<?= $mainImage->getUrl() ?>); position: relative">
        <div class="basic-info category-info">
            <h2><?= $category->$name ?></h2>
            <?= $desc_arr[0] ?>
        </div>
    </div>

    <div class="container" style="margin-top: 150px">
        <div class="row mb-4 text-left">
            <div class="col-md-5">
                <img class="w-100" src="img/category/1.jpg" alt="wedding decoration" style="border-radius: 0px 350px 350px 500px;">
            </div>
            <div class="col-lg-4 col-md-6 d-flex">
                <div class="align-self-center my-5">
                    <div class="description_text">
                        <?= $desc_arr[1] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 hide-on-mob">
            <div class="col-lg-4 col-md-6 d-flex offset-lg-3 offset-md-1 text-right">
                <div class="align-self-center my-5">
                    <div class="description_text">
                        <?= $desc_arr[2] ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <img class="w-100" src="img/category/2.jpg" alt="wedding decoration" style="border-radius: 350px 0px 500px 350px;">
            </div>
        </div>
        <div class="row mb-4 text-left mobile-wedding">
            <div class="col-md-5">
                <img class="w-100" src="img/img-placeholder.png" alt="">
            </div>
            <div class="col-lg-4 col-md-6 d-flex">
                <div class="align-self-center my-5">
                    <div class="description_text">
                        <?= $desc_arr[2] ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($gallery)):?>
        <div class="wedding-gallery pt-5">
            <h2 class="prata"><?= Yii::t('app', 'Gallery')?></h2>
            <p><?= Yii::t('app', 'See the amazing wedding gallery below') ?></p>
            <div class="wedding-gallery__images gallery_images">
                <?php foreach ($gallery as $image) : ?>
                    <div class="item" href="web/upload/store/gallery/<?= $image['img']?>">
                        <img src="web/upload/store/gallery/<?= $image['img']?>" class="img-thumbnail" alt="wedding image">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif;?>
        <?php if (isset($desc_arr[3])) : ?>
            <div class="category__more mt-5">
                <h4><?= $category->$name ?>, <?= Yii::t('app', 'more') ?> </h4>
                <div class="col-md-10 mx-auto text-left">
                    <?php
                    $i = 0;
                    $desc_arr_count = count($desc_arr);
                    for ($i; $i < $desc_arr_count; $i++) {
                        if ($i > 2) {
                            echo $desc_arr[$i];
                        }
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>

    </div>

</section>