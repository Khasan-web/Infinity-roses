<?php

use yii\helpers\Url;

?>
<section id="product-details">
		<div class="container">
			<div class="row">
				<h2 class="mt-5 px-2 w-100 text-center show-on-mob"><?= $product->productT[$lang]->name?> <span class="subheader">Collection</span></h2>
				<div class="col-lg-6 col-md-10 text-center">
					<img src="img/product/OnlyRoses-Metropolis-Footed-Bowl.jpg" alt="" class="active-img" data-color="red">
					<h2>About</h2>
					<div class="col-lg-8 col-md-10 mx-auto">
						<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate voluptates non laudantium iusto facere
							sapiente.</p>
					</div>
					<div class="col-lg-8 col-md-10 mx-auto">
						<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate voluptates non laudantium iusto facere
							sapiente.</p>
					</div>
				</div>
				<div class="col-lg-6 col-md-10 info">
					<h2 class="hide-on-mob"><?= $product->productT[$lang]->name?> <span class="subheader">Collection</span></h2>
					<div class="row mt-5 mb-4">
						<div class="col-md-6">
							<button class="btn btn-outline-dark w-100 toggle-parfume mb-1">Parfume</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-outline-dark w-100 toggle-chocolate mb-1">Chocolate</button>
						</div>
					</div>
					<div class="owl-carousel owl-theme parfume-carousel">
						<div data-id="1"><img src="img/product/parfume.jpg" alt=""></div>
						<div data-id="2"><img src="img/product/parfume.jpg" alt=""></div>
						<div data-id="3"><img src="img/product/parfume.jpg" alt=""></div>
						<div data-id="4"><img src="img/product/parfume.jpg" alt=""></div>
					</div>
					<div class="owl-carousel owl-theme chocolate-carousel">
						<div data-id="1"><img src="img/product/chocalte.png" alt=""></div>
						<div data-id="2"><img src="img/product/chocalte.png" alt=""></div>
						<div data-id="3"><img src="img/product/chocalte.png" alt=""></div>
						<div data-id="4"><img src="img/product/chocalte.png" alt=""></div>
					</div>
					<div class="row mb-4 info-panel">
						<div class="col-lg-4 col-md-4 col-4">
							<h3 class="mb-0">$<?= $product->price?></h3>
						</div>
						<div class="col-lg-4 col-md-4 col-8 size">
							<select class="custom-select d-inline">
								<option value="0" selected disabled>Choose Size</option>
								<option data-price="1500" value="lg">Large - 21 roses</option>
								<option data-price="1000" value="md">Medium - 17 roses</option>
								<option data-price="500" value="sm">Small - 9 roses</option>
							</select>
						</div>
						<div class="col-lg-4 col-md-4 col-12 my-4 my-lg-0 text-center">
							<button class="btn btn-dark add-to-cart" data-id="<?= $product->id?>">Add to card!</button>
						</div>
					</div>
					<hr>
					<div class="row colors">
						<div class="col-3 color">
							<img src="img/product/OnlyRoses-Metropolis-Footed-Bowl.jpg" alt="" data-color="red">
							<span>crimson</span>
						</div>
						<div class="col-3 color">
							<img src="img/product/1.jpg" alt="" data-color="blue">
							<span>blue</span>
						</div>
						<div class="col-3 color">
							<img src="img/product/2.jpg" alt="" data-color="violet">
							<span>violet</span>
						</div>
						<div class="col-3 color">
							<img src="img/product/3.jpg" alt="" data-color="green">
							<span>green</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<section id="popular-prods">
    <p class="subheader text-black">MOST CHOICE</p>
    <h1>POPULAR ROSES</h1>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-3 col-md-6 product">
                <a href="/product-details.html">
                    <img src="img/product/OnlyRoses-Metropolis-Footed-Bowl.jpg" alt="" class="w-100">
                    <h2 class="name">Roses name</h2>
                </a>
                <p class="price">from $575.00</p>
                
            </div>
            <div class="col-lg-3 col-md-6 product">
                <a href="/product-details.html">
                    <img src="img/product/OnlyRoses-Parthenon-Dome.jpg" alt="" class="w-100">
                    <h2 class="name">Roses name</h2>
                </a>
                <p class="price">from $575.00</p>
                
            </div>
            <div class="col-lg-3 col-md-6 product">
                <a href="/product-details.html">
                    <img src="img/product/OnlyRoses-FleurDuVinXmas-eComm_H.jpg" alt="" class="w-100">
                    <h2 class="name">Roses name</h2>
                </a>
                <p class="price">from $575.00</p>
                
            </div>
            <div class="col-lg-3 col-md-6 product">
                <a href="/product-details.html">
                    <img src="img/product/OnlyRoses-Infinite-Rose-Lady-Jan.jpg" alt="" class="w-100">
                    <h2 class="name">Roses name</h2>
                </a>
                <p class="price">from $575.00</p>
                
            </div>
        </div>
    </div>
</section>