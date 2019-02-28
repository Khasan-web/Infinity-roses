<?php

use yii\helpers\Url;

$name = 'name_' . Yii::$app->language;
$description = 'description_' . Yii::$app->language;

?>
<!-- navbar -->
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
      <li class="nav-item drop-item" role="button" id="gift-finder-item" aria-haspopup="true" aria-expanded="false">
        <a class="nav-link" href="<?= Url::to(['site/contact'])?>"><?= Yii::t('app', 'Gift Finder')?></a>
        <div class="dropdown-menu" id="finder" aria-labelledby="gift-finder-item">
          <div class="container">
            <div class="row mx-auto my-4">
              <div class="col-md-2 col-3">
                <h3>For:</h3>
              </div>
              <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="valentine" />
                  <label class="custom-control-label" for="customSwitches">Valentine's</label>
                </div>
              </div>
              <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="her" />
                  <label class="custom-control-label" for="customSwitches">Her</label>
                </div>
              </div>
              <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="him" />
                  <label class="custom-control-label" for="customSwitches">Him</label>
                </div>
              </div>
              <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="home" />
                  <label class="custom-control-label" for="customSwitches">Home</label>
                </div>
              </div>
            </div>
            <div class="row mx-auto my-4">
              <div class="col-md-2 col-3">
                <h3>Rose type:</h3>
              </div>
              <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="him" />
                  <label class="custom-control-label" for="customSwitches">Fresh ( Classic )</label>
                </div>
              </div>
              <div class="col-md-3 col-3 mx-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="home" />
                  <label class="custom-control-label" for="customSwitches">Long lasting roses ( Infinity )</label>
                </div>
              </div>
              <div class="col-md-1 col-0 mx-auto"></div>
              <div class="col-md-2 col-0 mx-auto"></div>
            </div>
            <div class="row mx-auto my-4">
              <div class="col-md-2 col-3">
                <h3>Price:</h3>
              </div>
              <div class="col-md-10 col-12 mx-auto">
                <input type="text" class="span2" value="" data-slider-tooltip="show" data-slider-min="0"
                  data-slider-max="1000" data-slider-step="5" data-slider-value="[0,1000]" id="dp5">
                <div class="row">
                  <div class="col-6 text-left pl-1">
                    <span class="price min">123</span>
                  </div>
                  <div class="col-6 text-right pr-1">
                    <span class="price max">123</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center my-4">
              <button class="btn btn-outline-gold">Find Roses!</button>
            </div>
          </div>
        </div>
      </li>
      <?php foreach ($this->categories as $cat):?>
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
                          <a href="<?= Url::to(['product/view', 'id' => $product->id])?>" data-image="<?= $image->getUrl()?>" class="product-item" ><?= $product->name;?></a>      
                        <?php endif;?>
                    </li>
                  <? endforeach;?>
                </ul>
              </div>
              <div class="col-lg-4 col-md-4 img-preview mx-auto">
                <img src="" alt="" />
              </div>
              <div class="col-lg-3 col-md-4 px-0 drop-desc">
                <h6><span><?= Yii::t('app', 'What are')?></span> <?= $cat->$name?>?</h6>
                <p class="description"><?= $cat->$description?></p>
              </div>
            </div>
          </div>
        </div>
      </li>
      <?php endforeach;?>
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