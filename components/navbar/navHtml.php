<?php

use yii\helpers\Url;
use app\components\GiftFinder;
use yii\helpers\Html;

$name = 'name_' . Yii::$app->language;
$description = 'description_' . Yii::$app->language;

?>
<!-- navbar -->
<div class="gradient"></div>
<div class="brand text-center py-3" id="nav-brand">
  <a href=""><img src="/img/main-logo.svg" class="wow fadeIn" width="120px" alt=""></a>
</div>
<nav class="navbar navbar-expand-lg w-100 p-0">
  <button class="navbar-toggler text-white my-2" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fas fa-bars navbar-toggler-icon"></i> Menu
  </button>
  <div class="show-on-mob my-2">
    <span class="nav-mob">
      <a href=""><i class="fas fa-search"></i></a>
    </span>
    <span class="nav-mob m-0">
      <a href=""><i class="fas fa-globe"></i></a>
    </span>
    <span class="nav-mob m-0">
      <a href=""><i class="fas fa-shopping-cart"></i></a>
    </span>
    <span class="nav-mob m-0">
      <a href="<?= Url::to(['site/login'])?>"><i class="fas fa-user"></i></a>
    </span>
  </div>
  <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav mx-auto">
      <?= GiftFinder::widget()?>
      <?php $i = 0;?>
      <?php foreach ($this->categories as $cat):?>
        <?php if ($cat->keywords != 'secondary'):?>
          <li class="nav-item drop-item" id="<?= $this->id?>">
            <a class="nav-link" href="<?= Url::to(['category/view', 'id' => $cat->id]);?>" role="button" id="luxuty-roses-item" aria-haspopup="true"
              aria-expanded="false"><?= $cat->$name?></a>
            <div class="dropdown-menu" aria-labelledby="luxuty-roses-item">
              <div class="container">
                <div class="row mb-5 mt-4 content">
                  <div class="col-lg-2 offset-lg-1 col-md-4">
                    <ul class="list-unstyled">
                      <?php foreach ($cat->product as $product): ?>
                      <?php $image = $product->getImage()?>
                        <li>
                            <?php if ($product->category_id == $cat->id): ?>
                              <?= Html::a($product->name, Url::to(['product/view', 'id' => $product->id]), $options = ['class' => 'product-item', 'data-image' => $image->getUrl()])?>
                            <?php endif;?>
                        </li>
                      <? endforeach;?>
                    </ul>
                  </div>
                  <div class="col-lg-4 col-md-4 img-preview mx-auto">
                      <img src="<?= $image->getUrl()?>" alt="" />
                  </div>
                  <div class="col-lg-3 col-md-4 px-0 drop-desc">
                    <h6><span><?= Yii::t('app', 'What are')?></span> <?= $cat->$name?>?</h6>
                    <?php
                    	$desc_arr = explode('</p>', $cat->$description);
                    ?>
                    <p><?= $desc_arr[0]?></p>
                  </div>
                </div>
              </div>
            </div>
          </li>
        <?php endif;?>
      <?php $i++; endforeach;?>
      <li class="nav-item">
        <a class="nav-link" href="<?= Url::to(['site/contact'])?>"><?= Yii::t('app', 'Contact Us');?></a>
      </li>
      <li class="nav-item icon-item mx-0 px-3">
        <a href="" class="nav-link" data-toggle="modal" data-target="#search"><i class="fas fa-search"></i></a>
      </li>
      <li class="nav-item icon-item mx-0 px-3">
        <a href="" class="nav-link" class="nav-link" data-toggle="modal" data-target="#langModal"><i class="fas fa-globe"></i></a>
      </li>
      <li class="nav-item icon-item mx-0 px-3">
        <a href="" class="nav-link showCart"><i class="fas fa-shopping-cart"></i></a>
      </li>
        <?php if (!Yii::$app->user->isGuest): ?>
        <li class="nav-item icon-item mx-0 px-3">
          <a href="<?= Url::to(['site/logout'])?>" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
        <?php endif;?>
        <li class="nav-item icon-item mx-0 px-3">
          <a href="<?= Url::to(['admin/'])?>" class="nav-link">
            <?php if (Yii::$app->user->isGuest): ?>
              <i class="fas fa-user"></i>
            <?php else:?>
              <i class="fas fa-cog"></i>
            <?php endif;?>
          </a>
      </li>
    </ul>
  </div>
</nav>