<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<div class="bg-image" style="background-image: url(img/home/luxury-roses.jpg)"></div>

<section id="contact">
		<section class="intro">
			<div class="col-lg-3 col-md-5 col-10 welcome-cart">
				<h1 class="gold "><?= Yii::t('app', 'Contacts')?></h1>
				<p><?= Yii::t('app', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima sint, quibusdam')?></p>
			</div>
		</section>
		<section class="contact-info container">
			<div class="row w-100 m-0">
				<div class="col-md-7 col-11 mx-auto p-0">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2996.8962213519353!2d69.27736991534478!3d41.311121208682636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8b2931f41f23%3A0x81095e06b654b845!2sSkver+Im.+Amira+Temura!5e0!3m2!1sen!2s!4v1548842253383"
					 width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="col-md-5 col-11 mx-auto location-info">
					<h4><?= Yii::t('app', 'Location')?>:</h4>
					<p>9631 Brighton Way Beverly Hills <br>
						Los Angeles, CA - 90210</p>
					<h4><?= Yii::t('app', 'Contacts')?>:</h4>
					<p>+9989 99 111 11 11 <br>
						+9989 90 111 11 11</p>
					<h4>Email:</h4>
					<p>info@infinity-roses.uz</p>
				</div>
			</div>
		</section>
		<section id="get-in-touch">
			<img src="img/white-logo.svg" alt="" class="bg-logo unselectable">
			<h1 class="gold text-center "><?= Yii::t('app', 'Get in touch')?></h1>
			<div class="col-lg-5 col-md-8 mx-auto gold-form">
				<form action="" class="mt-5">
					<div class="row">
						<div class="col-md-6">
							<input type="text" placeholder="<?= Yii::t('app', 'Full Name')?>" class="form-control">
						</div>
						<div class="col-md-6">
							<input type="text" placeholder="<?= Yii::t('app', 'Phone Number')?>" class="form-control">
						</div>
						<div class="col-md-12">
							<input type="text" placeholder="Email - <?= Yii::t('app', 'not important')?>" class="form-control">
						</div>
						<div class="col-md-12">
							<textarea type="text" placeholder="<?= Yii::t('app', 'Message')?>" class="form-control"></textarea>
						</div>
					</div>
					<button type="submit" class="btn btn-outline-gold"><?= Yii::t('app', 'Send the message')?>!</button>
				</form>
			</div>
		</section>
		<section id="social-media">
			<a href="#">
				<i class="fab fa-facebook-square"></i>
			</a>
			<a href="#">
				<i class="fas fa-camera-retro"></i>
			</a>
			<a href="#">
				<i class="fab fa-skype"></i>
			</a>
			<a href="#">
				<i class="fab fa-pinterest-square"></i>
			</a>
		</section>
	</section>