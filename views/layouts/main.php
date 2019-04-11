<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\components\Navbar;
use yii\bootstrap\Modal;

AppAsset::register($this);

$currentController = Yii::$app->controller->id;
$currentAction = Yii::$app->controller->action->id;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
  <meta charset="utf-8" />
  <base href="/" />

  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  <!-- You have to mention the card type. -->
<meta name="twitter:card" content="summary">

<!-- If you want you can mention the twitter profile of your website -->
<meta name="twitter:site" content="@qscuttertutor">

<!-- If you want you can mention the twitter profile of the author of the webpage. This is useful if the URL is a blog post. -->
<meta name="twitter:creator" content="@narayanprusty">

<!-- You have to mention the title of the webpage -->
<meta name="twitter:title" content="An Introduction To Twitter Card">

<!-- You have to mention a 2-4 lines description about the webpage -->
<meta name="twitter:description" content="Sometime just tweeting a URL is not enough to make the users more engaging and bringing traffic to your website or app. So Twitter introduced "Twitter Cards", using which we can make Twitter can generate a summarised preview of of our website or app and also provide basic information about what the webpage contains.">

<!-- If you want you can embed a URL of a image representing the content of your webpage. This image will be displayed in the preview and will make your post look more attractive. -->
<meta name="twitter:image" content="http://qnimate.com/myImage.png">

  <?php $this->registerCsrfMetaTags() ?>

  <!-- Template Basic Images Start -->
  <meta property="og:image" content="path/to/image.jpg" />
  <link rel="icon" href="img/favicon/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon-180x180.png" />
  <!-- Template Basic Images End -->

  <!-- Custom Browsers Color Start -->
  <meta name="theme-color" content="#000" />
  <!-- Custom Browsers Color End -->

  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<div id="loader"><img src="/img/loading.gif" alt="" width="150" /></div>
<?php //debug(Url::base(true) . Url::current())?>
<?= Navbar::widget()?>
<!-- Modal search -->
<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="search" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body gold-form">
        <form action="/category/search" method="get">
          <div class="btn-group w-100">
            <input type="search" autocomplete="off" name="q" class="form-control mb-0 search" style="border-radius: 3px 0 0 3px!important;" placeholder="<?= Yii::t('app', 'What do you want to find?')?>">
            <button type="submit" class="btn btn-outline-gold search-btn" style="padding: 3px 15px!important; border-radius: 0 3px 3px 0!important;">
              <?= Yii::t('app', 'Find')?>!
            </button>
          </div>
        </form>
        <ul class="list-unstyled auto-complete mt-3 ml-3">
        </ul>
      </div>
      <div class="modal-footer">
        <p class="mx-auto"><?= Yii::t('app', 'or use <a href="/product/gift-finder">Gift finder</a>')?></p>
      </div>
    </div>
  </div>
</div>

<!--Modal language -->
<div class="modal fade" id="langModal" tabindex="-1" role="dialog" aria-labelledby="lang" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content pt-3 text-center">
      <div class="modal-body gold-form">
        <div class="row text-center mb-3">
          <div class="col-6 mx-auto">
            <a href="<?= Url::to(["$currentController/$currentAction", 'language' => 'en', 'id' => Yii::$app->request->get('id')])?>"><img src="/img/langs/eng.png" alt="" width="30"><br>English</a>
          </div>
          <div class="col-6 mx-auto">
            <a href="<?= Url::to(["$currentController/$currentAction" , 'language' => 'ru', 'id' => Yii::$app->request->get('id')])?>"><img src="/img/langs/ru.png" alt="" width="30"><br>Русский</a>
          </div>
        </div>
        <a style="cursor: pointer" class="my-3" data-dismiss="modal" aria-label="Close"><?= Yii::t('app', 'Close')?></a>
      </div>
    </div>
  </div>
</div>


<!-- navbar end -->

<?= $content?>

<!-- cart modal -->
<div class="modal fade cart-style cart" id="cart-modal" tabindex="-1" role="dialog" aria-labelledby="cart-modal"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <?= Yii::t('app', 'Your Cart')?> | Infinity Roses
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body gold-form">

      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" aria-label="Close" class="btn btn-outline-gold hide-on-mob"><?= Yii::t('app', 'Continue shopping')?></button>
        <a href="<?= Url::to(['cart/view']);?>" class="btn btn-outline-success"><?= Yii::t('app', 'Formalize the order')?></a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="alert-modal" tabindex="-1" role="dialog" aria-labelledby="alert-modal"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          Infinity Roses
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body gold-form py-2">
        <p class="mb-0"></p>
      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" aria-label="Close" class="btn ok btn-outline-success">Yes</button>
      </div>
    </div>
  </div>
</div>

  <!-- footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 py-4">
          <h4><?= Yii::t('app', 'Location')?>:</h4>
          <p>Taras Shevchenko street 40 Tashkent</p>
        </div>
        <div class="col-lg-3 col-md-6 py-4">
          <h4><?= Yii::t('app', 'Contacts')?>:</h4>
          <p>
            +9989 99 111 11 11 <br />
            +9989 90 111 11 11
          </p>
        </div>
        <div class="col-lg-3 col-md-6 py-4 socials">
          <h4><?= Yii::t('app', 'Follow Us')?>:</h4>
          <div class="mb-2">
            <a target="_blank" title="facebook" href="https://www.facebook.com/infinityroses.uz/"><img src="img/icons/facebook.svg" alt="facebook"></a>
            <a target="_blank" title="instagram" href="https://www.instagram.com/infinityroses.uz/"><img src="img/icons/instagram.svg" alt="instagram"></a>
            <a target="_blank" title="youtube" href="#"><img src="img/icons/youtube.svg" alt="youtube"></a>
            <a target="_blank" title="telegram" href="#"><img src="img/icons/telegram.svg" alt="telegram"></a>
          </div>
          <p><?= Yii::t('app', 'Follow us and be aware <br/>of all news')?></p>
        </div>
        <div class="col-lg-3 col-md-6 py-4">
          <h4><?= Yii::t('app', 'Customers service')?>:</h4>
          <a href="#">Retrieve My Cart</a> <br />
          <a href="#">Terms Of Use</a> <br />
          <a href="#">Privacy</a> <br />
          <a href="#">FAQ (Frequently Asked Questions)</a> <br />
          <a href="#">Events</a> <br />
        </div>
      </div>
      <hr />
      <p class="text-center mb-0">www.infinityroses.uz</p>
    </div>
  </footer>
  
  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>