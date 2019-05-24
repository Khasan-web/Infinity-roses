<?php

use yii\helpers\Url;
use app\components\GiftFinder;
use yii\helpers\Html;

$name = 'name_' . Yii::$app->language;
$description = 'description_' . Yii::$app->language;

// active class in navbar
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$id = Yii::$app->request->get('id');

$active_category = Yii::$app->request->get('active-category');

$luxury_sub_cats = [];

?>
<!-- navbar -->
<div class="gradient"></div>
<div class="brand text-center py-3" id="nav-brand">
    <a href=""><img src="/img/main-logo.svg" class="wow fadeIn" width="120px" alt=""></a>
</div>
<nav class="navbar navbar-expand-lg w-100 p-0">
    <button class="navbar-toggler text-white my-2" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars navbar-toggler-icon"></i> <?= Yii::t('app', 'Menu') ?>
    </button>
    <div class="show-on-mob my-2">
        <span class="nav-mob">
            <a href="" data-toggle="modal" data-target="#search" title="<?= Yii::t('app', 'Search') ?>"><i class="fas fa-search"></i></a>
        </span>
        <span class="nav-mob m-0">
            <a href="" data-toggle="modal" data-target="#langModal" title="<?= Yii::t('app', 'Language') ?>"><i class="fas fa-globe"></i></a>
        </span>
        <span class="nav-mob m-0">
            <a href="" class="showCart" title="<?= Yii::t('app', 'Your Cart') ?>"><i class="fas fa-shopping-cart"></i></a>
        </span>
        <span class="nav-mob m-0">
            <a href="<?= Url::to(['site/login']) ?>" title="<?= Yii::t('app', 'Admin Panel') ?>"><i class="fas fa-user"></i></a>
        </span>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
            <?= GiftFinder::widget() ?>
            <?php $i = 0; ?>
            <?php foreach ($this->categories as $cat) : ?>
                <?php
                // show only independent categories and hide business section
                if ($cat->parent_id == 0 && !in_array('unique', explode(' ', $cat->keywords))) : ?>
                    <li class="nav-item drop-item <?= $id == $cat->id && $action == 'view' && $controller == 'category' || $active_category == $cat->id ? 'active' : '' ?>" id="<?= $cat->id ?>">
                        <a class="nav-link" style="padding: 3px 15px;" href="<?= Url::to(['category/view', 'id' => $cat->id]); ?>" role="button" id="dropdown-menu" aria-haspopup="true" aria-expanded="false"><?= $cat->$name ?></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-menu">
                            <div class="container">
                                <?php // show products of categories
                                $prods_exist = false;
                                if (!empty($cat->category)) {
                                    $prods_exist = true;
                                }
                                if (!empty($cat->product)) {
                                    $prods_exist = true;
                                }
                                if (!empty($cat->category) && boolval($prods_exist)) : ?>
                                    <div class="row mb-5 mt-4 content">
                                        <?php foreach ($cat->category as $subcat) : ?>
                                            <div class="col-lg-2 col-md-4 p-0">
                                                <a href="<?= Url::to(['category/' . $subcat->id]) ?>">
                                                    <h6><?= $subcat->$name ?></h6>
                                                </a>
                                                <ul class="list-unstyled">
                                                    <?php
                                                    // get products and their images
                                                    foreach ($subcat->product as $product) : ?>

                                                    <?php // caching products
                                                    if (Yii::$app->cache->exists($product['id'] . 'img')) {
                                                        $image = Yii::$app->cache->get($product['id'] . 'img');
                                                    } else {
                                                        $image_cache = $product->getImage();
                                                        Yii::$app->cache->set($product['id'] . 'img', $image_cache, 60);
                                                        $image = $image_cache;
                                                    }
                                                    // end caching products ?>

                                                        <li>
                                                            <?= Html::a($product->name, Url::to(['product/view', 'id' => $product->id]), $options = ['class' => 'product-item', 'data-image' => $image->getUrl('400x')]) ?>
                                                        </li>
                                                    <? endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="col-lg-4 col-md-4 img-preview mx-auto">
                                            <img src="<?= $image->getUrl() ?>" alt="" />
                                        </div>
                                        <div class="col-lg-3 col-md-4 px-0 drop-desc">
                                            <h6><span><?= Yii::t('app', 'About Luxury Collection') ?></span></h6>
                                            <?php $desc_arr = explode('</p>', $cat->$description); ?>
                                            <p><?= $desc_arr[0] ?></p>
                                        </div>
                                    </div>
                                <?php elseif (empty($cat->category) && boolval($prods_exist)) : ?>
                                    <div class="row mb-5 mt-4 content">
                                        <div class="col-lg-2 offset-lg-1 col-md-4">
                                            <ul class="list-unstyled">
                                                <?php
                                                // get products and their images
                                                foreach ($cat->product as $product) : ?>

                                                    <?php // caching products
                                                    if (Yii::$app->cache->exists($product->id . '_img')) {
                                                        $image = Yii::$app->cache->get($product->id . '_img');
                                                    } else {
                                                        $image_cache = $product->getImage();
                                                        Yii::$app->cache->set($product->id . '_img', $image_cache, 60);
                                                        $image = $image_cache;
                                                    }
                                                    // end caching products ?>

                                                    <li>
                                                        <?php if ($product->category_id == $cat->id) : ?>
                                                            <?= Html::a($product->name, Url::to(['product/view', 'id' => $product->id]), $options = ['class' => 'product-item', 'data-image' => $image->getUrl('400x')]) ?>
                                                        <?php endif; ?>
                                                    </li>
                                                <? endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4 col-md-4 img-preview mx-auto">
                                            <img src="<?= $image->getUrl() ?>" alt="" />
                                        </div>
                                        <div class="col-lg-3 col-md-4 px-0 drop-desc">
                                            <h6><span><?= Yii::t('app', 'A little about category') ?></span> «<?= $cat->$name ?>»</h6>
                                            <?php $desc_arr = explode('</p>', $cat->$description); ?>
                                            <p><?= $desc_arr[0] ?></p>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row cats">
                                        <?php foreach ($cat->category as $cat) : ?>
                                            <div class="col-lg-3 col-md-6 mx-auto">
                                                <a href="<?= Url::to(['category/' . $cat->id])?>">
                                                    <h5><?= $cat->$name?></h5>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="col-lg-3 col-md-6 mx-auto">
                                            <a href="<?= Url::to(['category/business'])?>">
                                                <h5><?= Yii::t('app', 'Roses for business')?></h5>
                                            </a>
                                        </div>
                                    </div>
                                <?php elseif (!boolval($prods_exist)):?>
                                    <h2 class="not-found text-center"><?= $cat->$name . ' ' . Yii::t('app', 'will be added soon!')?></h2>
                                <?php endif; ?>
 
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
                <?php $i++;
            endforeach; ?>
            <li class="nav-item <?= $controller == 'category' && $action == 'decoration-of-events' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= Url::to(['category/decoration-of-events']) ?>"><?= Yii::t('app', 'Decoration of Events'); ?></a>
            </li>
            <li class="nav-item <?= $controller == 'site' && $action == 'contact' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= Url::to(['site/contact']) ?>"><?= Yii::t('app', 'Contacts'); ?></a>
            </li>
            <li class="nav-item icon-item mx-0 px-3">
                <a href="" class="nav-link" data-toggle="modal" data-target="#search" title="<?= Yii::t('app', 'Search') ?>"><i class="fas fa-search"></i></a>
            </li>
            <li class="nav-item icon-item mx-0 px-3">
                <a href="" class="nav-link" data-toggle="modal" data-target="#langModal" title="<?= Yii::t('app', 'Language') ?>"><i class="fas fa-globe"></i></a>
            </li>
            <li class="nav-item icon-item showCart-item mx-0 px-3">
                <a href="" class="nav-link showCart"><i class="fas fa-shopping-cart"></i></a>
                <div class="cart-qty-container text-center"><span class="cart-qty"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : '0' ?></span></div>
            </li>
            <?php if (!Yii::$app->user->isGuest) : ?>
                <li class="nav-item icon-item mx-0 px-3">
                    <a href="<?= Url::to(['site/logout']) ?>" class="nav-link" title="<?= Yii::t('app', 'Sign Out') ?>">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            <?php endif; ?>
            <li class="nav-item icon-item mx-0 px-3">
                <a href="<?= Url::to(['admin/']) ?>" class="nav-link" title="<?= Yii::t('app', 'Admin Panel') ?>">
                    <?php if (Yii::$app->user->isGuest) : ?>
                        <i class="fas fa-user"></i>
                    <?php else : ?>
                        <i class="fas fa-cog"></i>
                    <?php endif; ?>
                </a>
            </li>
        </ul>
    </div>
</nav>