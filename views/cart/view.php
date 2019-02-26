<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<section id="cart" class="cart-style">

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
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<p class="mb-0"><?= Yii::$app->session->getFlash('error')?></p>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php endif;?>

		<h1 class="text-center">Your Cart</h1>
		<div class="container mt-5">

		<?php if (!empty($session['cart'])): ?>
		<table class="table">
			<thead>
			<tr>
				<th>Photo</th>
				<th>Name</th>
				<th>Size</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Parfume</th>
				<th>Chocolate</th>
				<th>Sum</th>
				<th><i class="fas fa-times"></i></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($session['cart'] as $item):?>
				<tr>
					<td><img class="img-prod" src="<?= $item['img']?>" alt="<?= $item['name']?>"></td>
					<td><a style="text-decoration: underline" href="<?= Url::to(['product/view', 'id' => $item['id']])?>"><?= $item['name']?></a></td>
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
				<td colspan="8">Common sum: </td>
				<td>$<?= $session['cart.sum']?></td>
			</tr>
			<tr>
				<td colspan="8">Common quantity: </td>
				<td><?= $session['cart.qty']?></td>
			</tr>
			</tbody>
		</table>

		<div class="order">
				<h1 class="text-center my-5">Place an Order</h1>
				<div class="row">
					<div class="col-md-6 black-form form">
						<?php $form = ActiveForm::begin()?>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($order, 'name')->input('name', ['placeholder' => 'Your Name'])?>
								</div>
								<div class="col-md-6">
									<?= $form->field($order, 'phone')->input('phone', ['placeholder' => 'Phone to contact with you'])?>
								</div>
								<div class="col-md-12">
									<?= $form->field($order, 'email')->input('email', ['placeholder' => 'Email as a second way to contact'])?>
								</div>
								<div class="col-md-12">
									<?= $form->field($order, 'address')->input('address', ['placeholder' => 'Address to give you roses'])?>
								</div>
							</div>
							<div class="text-center">
								<?= Html::submitButton('Order', ['class' => 'btn btn-outline-dark'])?>
							</div>
						<?php ActiveForm::end()?>
					</div>
					<div class="col-lg-4 col-md-6 text-left mt-4">
						<h4>Delivery</h4>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque soluta nihil ut sapiente. Dolorem, facilis
							accusantium est repellendus illum culpa!</p>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
							<label class="custom-control-label" for="customCheck">I agree with <a href="">terms and conditions</a></label>
						</div>
					</div>
					<div class="col-lg-2 col-md-5 mx-auto mt-4">
						<img src="img/gold-logo.svg" alt="">
					</div>
				</div>
			</div>

		<?php else:?>
		<div class="text-center py-5">
			<h2 class="not-found text-center pb-2 pt-0">Cart is empty...</h2>
			<a href="<?= Url::to(['/#popular-prods'])?>" class="btn btn-outline-dark">Explore Popular Products!</a>
		</div>
		<?php endif;?>
		</div>
	</section>