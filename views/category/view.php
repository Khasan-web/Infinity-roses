<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php
	$mainImage = $category->getImage();
	$desc_arr = explode('</p>', $category->$description);
?>

<!-- if the selected category is wedding decoration show another page structure -->
<?php if ($category->name_en == 'Wedding Decoration'):?>

<section id="cat" class="section-basic pt-0">

    <div class="event-img text-center" style="background-image: url(<?= $mainImage->getUrl()?>); position: relative">
        <div class="basic-info category-info">
            <h2><?= $category->$name?></h2>
            <?= $desc_arr[0]?>
        </div>
    </div>

    <div class="container" style="margin-top: 150px">
        <div class="row mb-4 text-left">
            <div class="col-md-5">
                <img class="w-100" src="img/category/1.jpg" alt="wedding decoration" style="border-radius: 0px 350px 350px 500px;">    
            </div>
            <div class="col-lg-4 col-md-6 d-flex">
                <div class="align-self-center my-5">
                    <div class="description_text">
						<?= $desc_arr[1]?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 hide-on-mob">
            <div class="col-lg-4 col-md-6 d-flex offset-lg-3 offset-md-1 text-right">
                <div class="align-self-center my-5">
                    <div class="description_text">
						<?= $desc_arr[2]?>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <img class="w-100" src="img/category/2.jpg" alt="wedding decoration" style="border-radius: 350px 0px 500px 350px;">    
            </div>
        </div>
        <div class="row mb-4 text-left mobile-wedding">
            <div class="col-md-5">
                <img class="w-100" src="img/img-placeholder.png" alt="">    
            </div>
            <div class="col-lg-4 col-md-6 d-flex">
                <div class="align-self-center my-5">
                    <div class="description_text">
						<?= $desc_arr[2]?>
                    </div>
                </div>
            </div>
        </div>

        <div class="wedding-gallery pt-5">
            <h2 class="prata">Gallery</h2>
            <p><?= Yii::t('app', 'See the amazing wedding gallery below')?></p>
            <div class="wedding-gallery__images gallery_images">
                <div class="item wow fadeIn" href="img/1.jpg">
                    <img src="img/1.jpg" class="img-thumbnail" alt="">
                </div>
                <div class="item wow fadeIn" href="img/2.jpg">
                <img src="img/2.jpg" class="img-thumbnail" alt="">
                </div>
                <div class="item wow fadeIn" href="img/2.jpg">
                <img src="img/2.jpg" class="img-thumbnail" alt="">
                </div>
                <div class="item wow fadeIn" href="img/1.jpg">
                    <img src="img/1.jpg" class="img-thumbnail" alt="">
                </div>
                <div class="item wow fadeIn" href="img/1.jpg">
                    <img src="img/1.jpg" class="img-thumbnail" alt="">
                </div>
                <div class="item wow fadeIn" href="img/2.jpg">
                <img src="img/2.jpg" class="img-thumbnail" alt="">
                </div>
            </div>
		</div>
		<?php if ($desc_arr[3]):?>
			<div class="category__more mt-5">
				<h4><?= $category->$name?>, <?= Yii::t('app', 'more')?> </h4>
				<div class="col-md-10 mx-auto text-left">
					<?php 
					$i = 0;
					$desc_arr_count = count($desc_arr);
					for ($i; $i < $desc_arr_count; $i++) {
						if ($i > 2) {
							echo $desc_arr[$i];
						}
					}
					?>
				</div>
			</div>
		<?php endif;?>

    </div>

</section>
<?php else:?>
	<section id="cat" class="pt-0">
		<div class="event-img" style="background-image: url(<?= $mainImage->getUrl()?>); position: relative">	
			<div class="basic-info category-info">
				<h2><?= $category->$name?></h2>
				<?= $desc_arr[0]?>
			</div>
		</div>
		<div class="container" style="margin-top: 150px">
			<?php if (!$products): ?>
				<h2 class="not-found"><?= Yii::t('app', 'There are not products in this category...');?></h2>
			<?php else:?>
			<div class="row mt-5">
				<?php foreach ($products as $product): ?>
				<?php $image = $product->getImage()?>
					<div class="col-lg-3 col-6 product wow fadeIn" data-wow-delay="0.6s">
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
			<div class="category__more">
				<h4><?= $category->$name?>, <?= Yii::t('app', 'more')?> </h4>
				<div class="col-md-10 mx-auto text-left">
					<?php 
					$i = 0;
					$desc_arr_count = count($desc_arr);
					for ($i; $i < $desc_arr_count; $i++) {
						if ($i != 0) {
							echo $desc_arr[$i];
						}
					}
					?>
				</div>
			</div>
		</div>
	</section>
<?php endif;?>