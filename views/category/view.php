<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php
// getting images and description
$mainImage = $category->getImage();
$desc_arr = explode('<p>br</p>', $category->$description);
?>

<section id="cat" class="pt-0">

	<!-- intro - image and first part of description -->
	<div class="event-img" style="background-image: url(<?= $mainImage->getUrl() ?>); position: relative">
		<div class="basic-info category-info">
			<h2><?= $category->$name ?></h2>
			<?= $desc_arr[0] ?>
		</div>
	</div>
	<!-- end intro -->

	<div class="container" style="margin-top: 150px">
		<?php // check does products were found
		if (empty($products) && empty($category->category)): ?>
			<h2 class="not-found"><?= Yii::t('app', 'There are not products in this category...'); ?></h2>
		<?php // if the product of the category linked to the parent category
		elseif (empty($category->category)): ?>

			<div class="row mt-5">
				<?php // products looping
				foreach ($products as $product): ?>

					<?php // caching product
                    if (Yii::$app->cache->exists($product->id . '_img')) {
                        $image = Yii::$app->cache->get($product->id . '_img');
                    } else {
                        $image_cache = $product->getImage();
                        Yii::$app->cache->set($product->id . '_img', $image_cache, 60);
                        $image = $image_cache;
                    }
                    // end caching product ?>

					<div class="col-lg-3 col-6 product wow fadeIn" data-wow-delay="0.6s">
						<a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>">
							<img src="<?= $image->getUrl() ?>" alt="" class="w-100" />
							<h2 class="name"><?= $product->name ?></h2>
						</a>
						<?php
						// getting lowest price
						$lowest_price;
						$i = 0;

						// caching prices of products
						if (Yii::$app->cache->exists($product->id . '_lowest')) {
							$prices = Yii::$app->cache->get($product->id . '_lowest');
						} else {
							$product_prices_cache = $product->prices;
							Yii::$app->cache->set($product->id . '_lowest', $product_prices_cache, 60);
							$prices = $product_prices_cache;
						}
						// end caching prices of products

						foreach ($prices as $price) {
							if ($i == 0) {
								$lowest_price = $price->price;
							}
							$price->price < $lowest_price ? $lowest_price = $price->price: $lowest_price;
						}
						?>
						<p class="price"><?= Yii::t('app', 'from') . ' ' . $lowest_price . ' ' . Yii::t('app', 'sum') ?></p>
					</div>
				<?php endforeach; // end products looping?>
			</div>

		<?php // if product linked to sub-categories of the category
		 else: ?>

			<?php // if there is any sub-category
			foreach ($category->category as $cat): ?>

			<?php // show info
			if (!empty($cat->product)): ?>
			<?php // getting info
			$sub_desc_arr = explode('<p>br</p>', $cat->$description);
			//end getting ?>
		 		<div class="sub-category text-left">
					<h3 class='prata'><?= $cat->$name?></h3>
					<?= $sub_desc_arr[0]?>

					<!-- detailed description -->
					<div class="more-info">
					<?php // getting detailed description
					$desc_arr_count = count($sub_desc_arr);
					for ($i = 0; $i < $desc_arr_count; $i++) {
						if ($i != 0) {
							// show description
							echo $sub_desc_arr[$i];
						}
					}
					// end getting the description?>
					<a class="a-underline more-info-show show" href="#"><?= Yii::t('app', 'Read more...')?></a>
					<!-- end detailed description -->

					</div>

				</div>
			<?php endif; // end showing info?>

			<div class="row mt-5">

					<?php // looping of sub-categories
					foreach ($cat->product as $product): ?>
					<?php // get a main image
					$image = $product->getImage() ?>

					<!-- show products -->
					<div class="col-lg-3 col-6 product wow fadeIn" data-wow-delay="0.6s">
						<a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>">
							<img src="<?= $image->getUrl() ?>" alt="" class="w-100" />
							<h2 class="name"><?= $product->name ?></h2>
						</a>
						<?php
						// lowest price
						$lowest_price;
						$i = 0;
						foreach ($product->prices as $price) {
							if ($i == 0) {
								$lowest_price = $price->price;
							}
							$price->price < $lowest_price ? $lowest_price = $price->price: $lowest_price;
						}
						?>
						<p class="price"><?= Yii::t('app', 'from') . ' ' . $lowest_price . ' ' . Yii::t('app', 'sum') ?></p>
					</div>
					<!-- end showing -->

					<?php endforeach; ?>

			</div>
			<?php endforeach; ?>

		<?php endif; ?>
		<div class="category__more">
			<!-- more description about category -->
			<h4><?= $category->$name ?>, <?= Yii::t('app', 'more') ?> </h4>
			<div class="col-md-10 mx-auto text-left">
				<?php // getting detailed description
				$desc_arr_count = count($desc_arr);
				for ($i = 0; $i < $desc_arr_count; $i++) {
					if ($i != 0) {
						// show description
						echo $desc_arr[$i];
					}
				}
				// end getting the description?>
			</div>
		</div>
	</div>
</section>