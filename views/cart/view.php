<?php

use yii\helpers\Url;

?>

<section id="cart" class="cart-style">
		<h1 class="text-center">Your Cart</h1>
		<div class="container mt-5">
			<table class="table">
				<thead>
					<tr>
						<th>Photo</th>
						<th>Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Sum</th>
						<th><i class="fas fa-times"></i></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><img src="img/product/4.jpg" alt="" class="img-prod"></td>
						<td>Test</td>
						<td>3</td>
						<td>$1500</td>
						<td>$4500</td>
						<td><i class="fas fa-times"></i></td>
					</tr>
					<tr>
						<td><img src="img/product/5.jpg" alt="" class="img-prod"></td>
						<td>Test</td>
						<td>3</td>
						<td>$1500</td>
						<td>$4500</td>
						<td><i class="fas fa-times"></i></td>
					</tr>
					<tr>
						<td><img src="img/product/6.jpg" alt="" class="img-prod"></td>
						<td>Test</td>
						<td>3</td>
						<td>$1500</td>
						<td>$4500</td>
						<td><i class="fas fa-times"></i></td>
					</tr>
					<tr>
						<td colspan="5">Common quantity: </td>
						<td width="50">9</td>
					</tr>
					<tr>
						<td colspan="5">Common sum: </td>
						<td>$13500</td>
					</tr>
				</tbody>
			</table>
			<div class="order">
				<h1 class="text-center my-5">Place an Order</h1>
				<div class="row">
					<div class="col-md-6 black-form form">
						<form action="">
							<div class="row">
								<div class="col-md-6">
									<input type="text" placeholder="Name" class="form-control">
								</div>
								<div class="col-md-6">
									<input type="text" placeholder="Phone" class="form-control">
								</div>
								<div class="col-md-12">
									<input type="text" placeholder="Email" class="form-control">
								</div>
								<div class="col-md-12">
									<input type="text" placeholder="Address" class="form-control">
								</div>
							</div>
							<button class="btn btn-outline-dark">Order!</button>
						</form>
					</div>
					<div class="col-lg-4 col-md-6 text-left">
						<h4>Delivery</h4>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque soluta nihil ut sapiente. Dolorem, facilis
							accusantium est repellendus illum culpa!</p>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
							<label class="custom-control-label" for="customCheck">I agree with <a href="">terms and conditions</a></label>
						</div>
					</div>
					<div class="col-lg-2 col-md-5 mx-auto">
						<img src="img/gold-logo.svg" alt="">
					</div>
				</div>
			</div>
		</div>
	</section>