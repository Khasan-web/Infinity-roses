<?php

use yii\helpers\Url;

?>

<div class="bg-image wow fadeIn" style="background-image: url('img/home/main.jpg')" data-wow-delay="0.4s"></div>

<section id="home-page">
  <section class="intro">
    <div class="col-lg-3 col-md-5 col-10 welcome-cart wow fadeIn" data-wow-delay="0.8s">
      <h1 class="gold"><?= Yii::t('app', 'WELCOME');?></h1>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima
        sint, quibusdam
      </p>
    </div>
  </section>
  <section id="about-us">
    <div class="about-bg wow fadeIn">
      <div class="content offset-lg-2 offset-md-2 pl-3 wow fadeIn" data-wow-delay="0.2s">
        <p class="subheader text-white">ABOUT</p>
        <h1 class="gold">INFINITY-ROSES</h1>
        <div class="col-lg-3 col-md-6 col-10 pl-0">
          <p>
            Lorem ipsum, dolor sit amet quia vel placeat, consectetur
            adipisicing elit. Asperiores voluptatem est voluptatum.
          </p>
          <p>
            Lorem ipsum dolor sit, amet adipisicing Distinctio, dolor.
            consectetur adipisicing elit.
          </p>
          <p>Lorem ipsum dolor sit amet consectetur</p>
        </div>
        <a href="<?= Url::to(['site/about'])?>" class="btn btn-outline-white mt-4">Get more!</a>
      </div>
    </div>
  </section>
  <section id="popular-prods">
    <p class="subheader text-black wow fadeIn" data-wow-delay="0.8s">MOST CHOICE</p>
    <h1 class="wow fadeIn">POPULAR ROSES</h1>
    <div class="container">
      <div class="row mt-5">
        <?php
          $delay = 0.6;
        ?>
        <?php foreach ($hits as $hit):?>
        <?php $delay += 0.2?>
          <div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="<?= $delay?>s">
            <a href="<?= Url::to(['product/view', 'id' => $hit->id])?>">
              <img src="img/product/<?= $hit->img?>" alt="" class="w-100" />
              <h2 class="name"><?= $hit->productT[$lang]->name?></h2>
            </a>
            <p class="price">from $<?= $hit->price?></p>
          </div>
        <?php endforeach;?>
        <!-- <div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="0.8s">
          <a href="/product-details.html">
            <img src="img/product/OnlyRoses-Parthenon-Dome.jpg" alt="" class="w-100" />
            <h2 class="name">Roses name</h2>
          </a>
          <p class="price">from $575.00</p>
        </div>
        <div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="1s">
          <a href="/product-details.html">
            <img src="img/product/OnlyRoses-FleurDuVinXmas-eComm_H.jpg" alt="" class="w-100" />
            <h2 class="name">Roses name</h2>
          </a>
          <p class="price">from $575.00</p>
        </div>
        <div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="1.2s">
          <a href="/product-details.html">
            <img src="img/product/OnlyRoses-Infinite-Rose-Lady-Jan.jpg" alt="" class="w-100" />
            <h2 class="name">Roses name</h2>
          </a>
          <p class="price">from $575.00</p>
          
        </div> -->
      </div>
    </div>
  </section>
  <div class="bg-white">
    <hr class="m-0" />
  </div>
  <section id="gift-finder">
    <p class="subheader text-black text-center wow fadeIn" data-wow-delay="0.8s">BENEGIT TOOL</p>
    <h1 class="wow fadeIn">GIFT FINDER</h1>
    <i class="fas fa-search bg-icon"></i>
    <div class="content offset-lg-2 offset-md-2 wow fadeIn">
      <div class="col-lg-4 col-md-6 col-12 offset-lg-2">
        <p>
          Lorem ipsum, dolor sit amet quia vel placeat, consectetur
          adipisicing elit. Asperiores voluptatem est voluptatum.
        </p>
        <p>
          Lorem ipsum dolor sit, amet adipisicing Distinctio, dolor.
          consectetur adipisicing elit.
        </p>
        <p>Lorem ipsum dolor sit amet consectetur</p>
        <a href="<?= Url::to(['site/gif-finder'])?>" class="btn btn-outline-dark mt-4">Get more!</a>
      </div>
    </div>
  </section>
  <section id="gift-finder">
      <p class="subheader text-black text-center wow fadeIn" data-wow-delay="0.8s">BENEGIT TOOL</p>
      <h1 class="wow fadeIn">SET CREATOR</h1>
      <i class="fas fa-plus bg-icon"></i>
      <div class="content offset-lg-2 offset-md-2 wow fadeIn">
        <div class="col-lg-4 col-md-6 col-12 offset-lg-2">
          <p>
            Lorem ipsum, dolor sit amet quia vel placeat, consectetur
            adipisicing elit. Asperiores voluptatem est voluptatum.
          </p>
          <p>
            Lorem ipsum dolor sit, amet adipisicing Distinctio, dolor.
            consectetur adipisicing elit.
          </p>
          <p>Lorem ipsum dolor sit amet consectetur</p>
          <button class="btn btn-outline-dark mt-4">Creat my own set!</button>
        </div>
      </div>
    </section>
  <section id="holidays">
    <div class="holiday wow fadeIn" style="background-image: url(img/home/lladro-banner-desktop.jpg)">
      <p class="date unselectable">14</p>
      <div class="card-holiday col-lg-3 col-md-6 col-12">
        <h2>Valentine's Day!</h2>
        <p>
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laborum,
          maiores.
        </p>
      </div>
    </div>
    <div class="holiday wow fadeIn" style="background-image: url(img/home/Verano-banner-section.jpg)">
      <p class="date unselectable">21</p>
      <div class="card-holiday col-lg-3 col-md-6 col-12">
        <h2>Nowruz!</h2>
        <p>
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laborum,
          maiores.
        </p>
      </div>
    </div>
  </section>
  <section id="contact-us">
    <h1>CONTACT US</h1>
    <div class="col-lg-3 col-md-6 col-10 mx-auto mt-4">
      <p>
        If you have any question, you can ask us from now! Our manager will
        answer as soon as possiable
      </p>
      <a href="/contact.html" class="btn btn-outline-gold">Contact!</a>
      <p class="subheader my-4">OR</p>
      <p>We will immediatly answer you in offline chat below on right</p>
    </div>
  </section>
  <section id="collection">
    <p class="subheader wow fadeIn" data-wow-delay="0.8s">COLLECTION SPOTLIGHT</p>
    <h1 class="wow fadeIn">The Infinite Luxury Collection</h1>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="0.6s">
              <a href="/product-details.html">
                <img src="img/product/OnlyRoses-Metropolis-Footed-Bowl.jpg" alt="" class="w-100" />
                <h2 class="name">Roses name</h2>
              </a>
              <p class="price">from $575.00</p>
              
            </div>
            <div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="0.8s">
              <a href="/product-details.html">
                <img src="img/product/OnlyRoses-Parthenon-Dome.jpg" alt="" class="w-100" />
                <h2 class="name">Roses name</h2>
              </a>
              <p class="price">from $575.00</p>
              
            </div>
            <div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="1s">
              <a href="/product-details.html">
                <img src="img/product/OnlyRoses-FleurDuVinXmas-eComm_H.jpg" alt="" class="w-100" />
                <h2 class="name">Roses name</h2>
              </a>
              <p class="price">from $575.00</p>
              
            </div>
            <div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="1.2s">
              <a href="/product-details.html">
                <img src="img/product/OnlyRoses-Infinite-Rose-Lady-Jan.jpg" alt="" class="w-100" />
                <h2 class="name">Roses name</h2>
              </a>
              <p class="price">from $575.00</p>
              
            </div>
          </div>
          <button class="btn btn-outline-dark btn-more my-4 wow fadeIn" data-wow-delay="1.5s"><i class="fas fa-plus"></i></button>
    </div>
  </section>
</section>
