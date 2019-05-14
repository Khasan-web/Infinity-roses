<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>

<section id="cart-page" class="cart-style cart">

    <?php if (Yii::$app->session->hasFlash('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show container" role="alert">
        <h4 class="alert-heading"><?= Yii::t('app', 'Thank you for the order')?>!</h4>
        <p><?= Yii::$app->session->getFlash('success') ?></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger alert-dismissible container fade show" role="alert">
        <p class="mb-0"><?= Yii::$app->session->getFlash('error') ?></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <h2 class="text-center table-container prata fsize_h1"><?= Yii::t('app', 'Your Cart') ?></h2>
    <div class="container mt-5">
        <div class="table-responsive">
            <?php if (!empty($session['cart'])) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th><?= Yii::t('app', 'Photo') ?></th>
                        <th><?= Yii::t('app', 'Product name') ?></th>
                        <th><?= Yii::t('app', 'Size') ?></th>
                        <th><?= Yii::t('app', 'Price') ?></th>
                        <th><?= Yii::t('app', 'Quantity') ?></th>
                        <th><?= Yii::t('app', 'Vase') ?></th>
                        <th><?= Yii::t('app', 'Sum') ?></th>
                        <th><i class="fas fa-times"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($session['cart'] as $item) : ?>
                    <tr>
                        <td><img class="img-prod" src="<?= $item['img'] ?>" alt="<?= $item['name'] ?>"></td>
                        <td><a target="_blank" style="text-decoration: underline"
                                href="<?= Url::to(['product/view', 'id' => $item['id']]) ?>"><?= $item['name'] ?></a>
                        </td>
                        <td><?= $item['size'] ?></td>
                        <td><?= priceWithSpaces($item['price']) . ' ' . Yii::t('app', 'sum')?></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?php
                                    if ($item['vase'] == 'true') {
                                        echo 'Yes';
                                    } else {
                                        echo '--';
                                    }
                                    ?></td>
                        <td><?= priceWithSpaces($item['qty'] * $item['price'])?>
                            <?= Yii::t('app', 'sum') ?></td>
                        <td><i class="fas fa-times del-item" data-id="<?= $item['id'] ?>"></i></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="7"><?= Yii::t('app', 'Common sum:') ?></td>
                        <td><?= priceWithSpaces($session['cart.sum']) . ' ' . Yii::t('app', 'sum')?>
                    </tr>
                    <tr>
                        <td colspan="7"><?= Yii::t('app', 'Common quantity:') ?></td>
                        <td><?= $session['cart.qty'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="order black-form form">
            <?php $form = ActiveForm::begin([
                    'id' => 'order'
                ]) ?>
            <h2 class="text-center my-5"><?= Yii::t('app', 'Order Form') ?></h2>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($order, 'name')->input('name', ['placeholder' => Yii::t('app', 'Full Name')]) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($order, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99) 999-99-99',]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $form->field($order, 'email')->input('email', ['placeholder' => Yii::t('app', 'Sending a list of your products')]) ?>
                        </div>
                        <div class="col-lg-12 px-3 form-check-inline address">
                            <?= $form->field($order, 'address')->input('address', ['placeholder' => Yii::t('app', 'Shipping address')]) ?>
                            <i class="fas fa-map-marked-alt show-on-map" title="<?= Yii::t('app', 'Choose a location on the map') ?>"></i>
                        </div>
                        <p class="px-3"><?= Yii::t('app', 'Please enter your address and select your location on the map by clicking on the map icon, and then you will get your roses even faster')?>!</p>
                    </div>
                </div>
                <div class="col-lg-4 text-left mt-4">
                    <h4><?= Yii::t('app', 'Delivery') ?></h4>
                    <p><?= Yii::t('app', 'Infinity Roses provide free delivery within just 40-60 minutes in Tashkent city. If you are in another city, we will inform you about the time and price of delivery by phone.') ?>
                    </p>
                    <p><?= Yii::t('app', 'You agree to the') ?> <a href=""
                            style="text-decoration: underline"><?= Yii::t('app', 'terms and conditions') ?></a></p>
                </div>
                <div class="col-lg-2 col-5 mx-auto my-4 hide-on-mob">
                    <img src="img/gold-logo.svg" alt="">
                </div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-dark btn-block"><i class="fas fa-box-open"></i>
                        <?= Yii::t('app', 'Order') ?></button>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>

    <?php else : ?>
    <div class="container">
        <div class="text-center py-5">
            <h2 class="not-found text-center pb-2 pt-0"><?= Yii::t('app', 'Cart is empty') ?>...</h2>
        </div>
        <section id="popular-prods">
            <p class="subheader text-black text-uppercase"><?= Yii::t('app', 'Most choice') ?></p>
            <h2 class="prata fsize_h1"><?= Yii::t('app', 'Popular Roses') ?></h2>
            <div class="container">
                <div class="row mt-5">
                    <?php
                    $delay = 0.6;
                    ?>
                    <?php foreach ($hits as $hit) : ?>
                    <?php if ($hit->hit) : ?>
                    <?php
                    $delay += 0.2;
                    $image = $hit->getImage();
                    ?>
                    <div class="col-lg-3 col-6 product wow fadeIn" data-wow-delay="<?= $delay ?>s">
                        <a href="<?= Url::to(['product/view', 'id' => $hit->id]) ?>">
                            <img src="<?= $image->getUrl() ?>" alt="" class="w-100" />
                            <h2 class="name"><?= $hit->name?></h2>
                        </a>
                        <p class="price"><?= $hit->category->$name?></p>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
    <?php endif; ?>

    <div class="map-section">
        <div id="map" class="mt-5"></div>
    </div>
</section>