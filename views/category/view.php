<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php
	$mainImage = $category->getImage();
	$desc_arr = explode('</p>', $category->$description);
?>

<section id="cat" class="pt-0">
	<div class="event-img" style="background-image: url(<?= $mainImage->getUrl()?>); position: relative">	
		<div class="basic-info category-info">
			<h2><?= $category->$name?></h2>
			<p><?= $desc_arr[0]?></p>
		</div>
	</div>
	<div class="container" style="margin-top: 150px">
		<?php if (!$products): ?>
			<h2 class="not-found"><?= Yii::t('app', 'There are not products in this category...');?></h2>
		<?php else:?>
		<div class="row mt-5">
			<?php foreach ($products as $product): ?>
			<?php $image = $product->getImage()?>
				<div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="0.6s">
					<a href="<?= Url::to(['product/view', 'id' => $product->id])?>">
						<img src="<?= $image->getUrl()?>" alt="" class="w-100" />
						<h2 class="name"><?= $product->name?></h2>
					</a>
					<?php
						// lowest price
						$lowest_price;
						$i = 0;
						foreach ($product->prices as $price) {
							if ($i == 0) {
								$lowest_price = $price->price;
							}
							$price->price < $lowest_price ? $lowest_price = $price->price : $lowest_price;
						}
					?>
					<p class="price">from $<?= $lowest_price?></p>
				</div>
			<?php endforeach;?>
		</div>
		<?php endif;?>
		<h4><?= $category->$name?>, <?= Yii::t('app', 'more')?> </h4>
		<div class="col-md-10 mx-auto">
			<?php 
			$i = 0;
			$desc_arr_count = count($desc_arr);
			for ($i; $i < $desc_arr_count; $i++) {
				if ($i != 0) {
					echo "<p>$desc_arr[$i]</p>";
				}
			}
			?>
		</div>
	</div>
</section>