<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<section id="cat">
	<h2 class="wow fadeIn prata fsize_h1"><?= Html::encode($q)?></h2>
	<div class="line gold-bg my-3"></div>
	<div class="container">
		<?php if (!$products): ?>
			<h2 class="not-found"><?= Yii::t('app', 'Nothing is found...');?></h2>
		<?php else:?>
		<div class="row mt-5">
			<?php foreach ($products as $product): ?>
			<?php $image = $product->getImage()?>
				<div class="col-lg-3 col-6 product wow fadeIn" data-wow-delay="0.6s">
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