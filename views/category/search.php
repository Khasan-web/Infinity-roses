<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<section id="cat">
	<h1 class="wow fadeIn"><?= Html::encode($q)?></h1>
	<div class="line gold-bg my-3"></div>
	<div class="col-lg-4 col-md-8 mx-auto wow fadeIn" data-wow-delay="0.8s">
		<div class="col-md-7 mx-auto">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa, qui?</p>
        </div>
	</div>
	<div class="container">
		<?php if (!$products): ?>
			<h2 class="not-found"><?= Yii::t('app', 'Nothing is found...');?></h2>
		<?php else:?>
		<div class="row mt-5">
			<?php foreach ($products as $product): ?>
				<div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="0.6s">
					<a href="/product-details.html">
						<img src="img/product/<?= $product->product->img?>" alt="" class="w-100" />
						<h2 class="name"><?= $product->name?></h2>
					</a>
					<p class="price">$<?= $product->product->price?></p>
					<button class="btn btn-outline-dark">Add to Cart!</button>
				</div>
			<?php endforeach;?>
		</div>
		<?php endif;?>
	</div>
</section>