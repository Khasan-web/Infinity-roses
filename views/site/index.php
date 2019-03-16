<?php

use yii\helpers\Url;
use yii\helpers\StringHelper;
?>

<!-- show the last added events -->

<?php
  $date = date('d');
?>
  <!-- <div class="notifications">
    <?php $i = 0?>
    <?php foreach ($events as $event):?>
      <?php
        $eventDay = date('d', strtotime($event->date_from));
        $eventEnd = date('d', strtotime($event->date_to));
      ?>
      <?php if ($date > $eventDay || $date < $eventEnd && $i == 1):?>
          <div class="notification col-md-3 col-sm-12">
            <div class="close"><i class="fa fa-times"></i></div>
            <h3><?= $event->name?></h3>
            <p><?= StringHelper::byteSubstr($event->$description, 0, 100 - 1)?></p>
            <a href="<?= Url::to(['events/view', 'id' => $event->id])?>" class="btn btn-outline-gold">Explore</a>
          </div>
      <?php $i++; endif;?>
    <?php endforeach;?>
</div> -->

<div class="bg-image wow fadeIn" style="background-image: url('img/home/main.jpg')" data-wow-delay="0.4s"></div>

<section id="home-page">
  <section class="intro">
    <div class="col-lg-3 col-md-5 col-10 welcome-cart wow fadeIn" data-wow-delay="0.8s">
      <h1 class="gold"><?= Yii::t('app', 'Welcome');?></h1>
      <p>
        <?= Yii::t('app', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima
        sint, quibusdam') // not set?>
      </p>
    </div>
  </section>
  <?php if ($hits):?>
    <section id="popular-prods">
      <p class="subheader text-black wow fadeIn" data-wow-delay="0.8s"><?= Yii::t('app', 'MOST CHOICE')?></p>
      <h1 class="wow fadeIn"><?= Yii::t('app', 'Popular roses')?></h1>
      <div class="container">
        <div class="row mt-5">
            <?php $delay = 0.6;?>
            <?php foreach ($hits as $hit):?>
            <?php 
              $delay += 0.2;
              $image = $hit->getImage();
            ?>
              <div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="<?= $delay?>s">
                <a href="<?= Url::to(['product/view', 'id' => $hit->id])?>">
                  <img src="<?= $image->getUrl()?>" alt="" class="w-100" />
                  <h2 class="name"><?= $hit->name?></h2>
                </a>
                <p class="price"><?= $hit->category->$name?></p>
              </div>
            <?php endforeach;?>
        </div>
      </div>
    </section>
  <?php endif;?>
  <section id="about-us">
    <div class="about-bg wow fadeIn">
      <div class="content offset-lg-2 offset-md-2 pl-3 wow fadeIn" data-wow-delay="0.2s">
        <p class="subheader text-white"><?= Yii::t('app', 'About')?></p>
        <h1 class="gold">Infinity roses</h1>
        <div class="col-lg-3 col-md-6 col-10 pl-0">
          <p><?= Yii::t('app', 'Lorem ipsum, dolor sit amet quia vel placeat, consectetur
            adipisicing elit. Asperiores voluptatem est voluptatum.') //not set?></p>
        </div>
        <a href="<?= Url::to(['site/about'])?>" class="btn btn-outline-white mt-4"><?= Yii::t('app', 'Get more')?>!</a>
      </div>
    </div>
  </section>
  <div class="bg-white">
    <hr class="m-0" />
  </div>
  <section id="gift-finder">
    <p class="subheader text-black text-center wow fadeIn" data-wow-delay="0.8s"><?= Yii::t('app', 'BENEFIT TOOL')?></p>
    <h1 class="wow fadeIn"><?= Yii::t('app', 'Gift Finder')?></h1>
    <i class="fas fa-search bg-icon"></i>
    <div class="content offset-lg-2 offset-md-2 wow fadeIn">
      <div class="col-lg-4 col-md-6 col-12 offset-lg-2">
        <p><?= Yii::t('app', 'Lorem ipsum, dolor sit amet quia vel placeat, consectetur
          adipisicing elit. Asperiores voluptatem est voluptatum.') // not set?></p>
        <a href="<?= Url::to(['product/gift-finder'])?>" class="btn btn-outline-dark mt-4"><?= Yii::t('app', 'Get more')?>!</a>
      </div>
    </div>
  </section>
  <section id="gift-finder">
      <p class="subheader text-black text-center wow fadeIn" data-wow-delay="0.8s"><?= Yii::t('app', 'BENEFIT TOOL')?></p>
      <h1 class="wow fadeIn"><?= Yii::t('app', 'Set creator')?></h1>
      <i class="fas fa-plus bg-icon"></i>
      <div class="content offset-lg-2 offset-md-2 wow fadeIn">
        <div class="col-lg-4 col-md-6 col-12 offset-lg-2">
          <p><?= Yii::t('app', 'Lorem ipsum, dolor sit amet quia vel placeat, consectetur
            adipisicing elit. Asperiores voluptatem est voluptatum.') //not set?></p>
          <button class="btn btn-outline-dark mt-4">Creat my own set!</button>
        </div>
      </div>
    </section>
  <section id="holidays">
  <?php if ($events):?>
    <?php foreach ($events as $event):?>
      <?php $image = $event->getImage()?>
        <a href="<?= Url::to(["events/{$event->id}"])?>">
          <div class="holiday wow fadeIn" style="background-image: url(<?= $image->getUrl()?>)">
          <?php
            $date = strtotime($event->date_to);
            $day = date('d', $date);
            $day_split = str_split($day);
            if ($day_split[0] == '0') {
              $day = $day_split[1];
            }
          ?>
          <p class="date unselectable"><?= $day?></p>
          <div class="card-holiday col-lg-3 col-md-6 col-12">
            <h2><?= $event->name?></h2>
            <p><?= StringHelper::byteSubstr($event->$description, 0, 100 - 1)?></p>
          </div>
      </div>
    <?php endforeach;?>
  <?php endif;?>
  </section>
  <section id="contact-us">
    <h1 class=""><?= Yii::t('app', 'Contact Us')?></h1>
    <div class="col-lg-3 col-md-6 col-10 mx-auto mt-4">
      <p><?= Yii::t('app', 'If you have any question, you can ask us from now! Our manager will
        answer as soon as possiable') //not set?></p>
      <a href="<?= Url::to(['site/contact'])?>" class="btn btn-outline-gold"><?= Yii::t('app', 'Contact Us')?>!</a>
      <p class="subheader my-4"><?= Yii::t('app', 'OR')?></p>
      <p><?= Yii::t('app', 'We will immediately reply to you in the chat in the lower right corner.')?></p>
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