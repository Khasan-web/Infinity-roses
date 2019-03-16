<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>

<section id="cart" class="cart-style cart">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show container" role="alert">
        <h4 class="alert-heading">Thank you to order!</h4>
        <p><?= Yii::$app->session->getFlash('success')?></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif;?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissible container fade show" role="alert">
        <p class="mb-0"><?= Yii::$app->session->getFlash('error')?></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif;?>

    <h1 class="text-center"><?= Yii::t('app', 'Your Cart')?></h1>
    <div class="container table-container mt-5">

        <?php if (!empty($session['cart'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th><?= Yii::t('app', 'Photo')?></th>
                    <th><?= Yii::t('app', 'Product name')?></th>
                    <th><?= Yii::t('app', 'Size')?></th>
                    <th><?= Yii::t('app', 'Price')?></th>
                    <th><?= Yii::t('app', 'Quantity')?></th>
                    <th><?= Yii::t('app', 'Parfume')?></th>
                    <th><?= Yii::t('app', 'Chocolate')?></th>
                    <th><?= Yii::t('app', 'Sum')?></th>
                    <th><i class="fas fa-times"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($session['cart'] as $item):?>
                <tr>
                    <td><img class="img-prod" src="<?= $item['img']?>" alt="<?= $item['name']?>"></td>
                    <td><a target="_blank" style="text-decoration: underline"
                            href="<?= Url::to(['product/view', 'id' => $item['id']])?>"><?= $item['name']?></a></td>
                    <td><?= $item['size']?></td>
                    <td>$<?= $item['price']?></td>
                    <td><?= $item['qty']?></td>
                    <td>
                        <?= $item['parfume']?>
                    </td>
                    <td><?= $item['chocolate']?></td>
                    <td>$<?= $item['qty'] * $item['price']?></td>
                    <td><i class="fas fa-times del-item" data-id="<?= $item['id']?>"></i></td>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="8"><?= Yii::t('app', 'Common sum:')?></td>
                    <td>$<?= $session['cart.sum']?></td>
                </tr>
                <tr>
                    <td colspan="8"><?= Yii::t('app', 'Common quantity:')?></td>
                    <td><?= $session['cart.qty']?></td>
                </tr>
            </tbody>
        </table>

        <div class="order">
            <h2 class="text-center my-5"><?= Yii::t('app', 'Place an Order')?></h2>
            <div class="row">
                <div class="col-md-6 black-form form">
                    <?php $form = ActiveForm::begin()?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($order, 'name')->input('name', ['placeholder' => Yii::t('app', 'Full Name')])?>
                        </div>
                        <div class="col-md-6">
							<?= $form->field($order, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99) 999-99-99',])?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($order, 'email')->input('email', ['placeholder' => Yii::t('app', 'Sending a list of your products')])?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($order, 'address')->input('address', ['placeholder' => Yii::t('app', 'Shipping address')])?>
                        </div>
                    </div>
                    <div class="text-center">
                        <?= Html::submitButton(Yii::t('app', 'Order'), ['class' => 'btn btn-dark btn-block btn-lg'])?>
                    </div>
                    <?php ActiveForm::end()?>
                </div>
                <div class="col-lg-4 col-md-6 text-left mt-4">
                    <h4><?= Yii::t('app', 'Delivery')?></h4>
                    <p><?= Yii::t('app', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque soluta nihil ut sapiente. Dolorem, facilis
							accusantium est repellendus illum culpa! <a href="" style="text-decoration: underline">terms and conditions</a>')?>
                    </p>
                </div>
                <div class="col-lg-2 col-md-5 mx-auto mt-4">
                    <img src="img/gold-logo.svg" alt="">
                </div>
            </div>
        </div>

        <?php else:?>
        <div class="text-center py-5">
            <h2 class="not-found text-center pb-2 pt-0"><?= Yii::t('app', 'Cart is empty')?>...</h2>
            <a href="<?= Url::to(['/#popular-prods'])?>" class="btn btn-outline-dark">Explore Popular Products!</a>
        </div>
        <?php endif;?>
    </div>
</section>