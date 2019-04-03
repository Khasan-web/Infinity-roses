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
			<?php $image = $product->getImage()?>
				<div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="0.6s">
					<a href="<?= Url::to(['product/view', 'id' => $product->id])?>">
						<img src="<?= $image->getUrl()?>" alt="" class="w-100" />
						<h2 class="name"><?= $product->name?></h2>
					</a>
					<p class="price"><?= $product->category->$name?></p>
				</div>
			<?php endforeach;?>
		</div>
		<?php endif;?>
	</div>
</section>