<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

?>

<div class="bg-image" style="background-image: url('<?= $background['filePath'] ?>')"></div>

<section id="contact">
		<section class="intro">
			<div class="col-lg-3 col-md-5 col-10 welcome-cart">
            <h2 class="gold prata fsize_h1"><?= $background[$title] ?></h2>
            <p><?= $background[$description] ?></p>
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
					<p>Taras Shevchenko street 40 Tashkent</p>
					<h4><?= Yii::t('app', 'Contacts')?>:</h4>
					<p>+9989 99 001 11 22
					<h4>Email:</h4>
					<p>info@infinityroses.uz</p>
				</div>
			</div>
		</section>
		<section id="get-in-touch">
			<img src="img/white-logo.svg" alt="" class="bg-logo unselectable">
			<h2 class="gold text-center prata fsize_h1"><?= Yii::t('app', 'Get in touch')?></h2>
			<div class="col-lg-5 col-md-8 mx-auto gold-form">
			<?php $form = ActiveForm::begin([
				'options' => [
					'class' => 'mt-5',
				],
			]);?>
				<div class="row">
					<div class="col-md-6">
						<?= $form->field($model, 'name')->textInput(['placeholder' => Yii::t('app', 'Full Name')])->label(false);?>
					</div>
					<div class="col-md-6">
						<?= $form->field($model, 'phone')->textInput(['placeholder' => Yii::t('app', 'Phone Number')])->label(false);?>
					</div>
					<div class="col-md-12">
						<?= $form->field($model, 'email')->textInput(['placeholder' => 'Email - ' . Yii::t('app', 'not important')])->label(false);?>
					</div>
					<div class="col-md-12">
						<?= $form->field($model, 'message')->textarea(['placeholder' => Yii::t('app', 'Message')])->label(false);?>
					</div>
				</div>
				<?= Html::submitButton(Yii::t('app', 'Send the message') . '!', ['class' => 'btn btn-outline-gold'])?>
			<?php ActiveForm::end();?>
			</div>
		</section>
		<section class="socials">
			<a target="_blank" title="facebook" href="https://www.facebook.com/infinityroses.uz/"><img src="img/icons/facebook.svg" alt="facebook"></a>
            <a target="_blank" title="instagram" href="https://www.instagram.com/infinityroses.uz/"><img src="img/icons/instagram.svg" alt="instagram"></a>
			<a target="_blank" title="telegram" href="https://t.me/infinityroses"><img src="img/icons/telegram.svg" alt="telegram"></a>
			<a class="disabled-link" onclick="return false" target="_blank" title="youtube" href="#"><img src="img/icons/youtube.svg" alt="youtube"></a>
			<div class="col-md-4 col-12 mx-auto mt-4">
				<p><?= Yii::t('app', 'Follow us and be aware <br/>of all news')?></p>
			</div>
		</section>
	</section>