<?php

use yii\helpers\Url;

// get images and description
$main_image = $category->getImage();
// get description
$desc_arr = explode('<p>br</p>', $category->$description);

?>

<section id="cat" class="section-basic pt-0">

    <div class="event-img text-center" style="background-image: url(<?= $main_image->getUrl()?>); position: relative">
        <div class="basic-info category-info">
            <h2><?= $category->$name?></h2>
            <p class="col-md-10 mx-auto"><?= $desc_arr[0]?></p>
        </div>
    </div>

    <div class="container" style="padding-top: 100px">
        <div class="gallery_images container">
            <?php foreach ($gallery as $image):?>
                <div class="item" href="web/upload/store/gallery/<?= $image['img']?>">
                    <img src="web/upload/store/gallery/<?= $image['img']?>" class="img-thumbnail" alt="<?= $category->name_en?>">
                </div>
            <?php endforeach;?>
            <h2 class="not-found d-none my-5"><?= Yii::t('app', 'Soon...')?></h2>
        </div>
        <a href="<?= Url::to(['site/contact'])?>" class="btn btn-outline-dark mt-4"><?= Yii::t('app', 'All Contact Information')?></a>
        <p class="mb-0 mt-5">+9989 (99) 001-11-22</p>
        <p><?= Yii::t('app', 'Or call us now!')?></p>
    </div>

</section>