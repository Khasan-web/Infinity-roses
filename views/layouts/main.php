<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\components\Navbar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
  <meta charset="utf-8" />
  <base href="/" />
  
  <meta name="description" content="" />

  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

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

<!-- navbar -->
<div class="brand text-center py-3" id="nav-brand">
  <a href=""><img src="/img/main-logo.svg" class="wow fadeIn" width="120px" alt=""></a>
</div>
<nav class="navbar navbar-expand-lg w-100 p-0">
  <button class="navbar-toggler text-white my-2" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fas fa-bars navbar-toggler-icon"></i> Menu
  </button>
  <div class="show-on-mob my-2">
    <span class="nav-mob">
      <a href=""><i class="fas fa-search"></i></a>
    </span>
    <span class="nav-mob m-0">
      <a href=""><i class="fas fa-globe"></i></a>
    </span>
    <span class="nav-mob m-0">
      <a href=""><i class="fas fa-shopping-cart"></i></a>
    </span>
    <span class="nav-mob m-0">
      <a href="<?= Url::to(['site/login'])?>"><i class="fas fa-user"></i></a>
    </span>
  </div>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item drop-item" role="button" id="gift-finder-item" aria-haspopup="true" aria-expanded="false">
        <a class="nav-link" href="<?= Url::to(['site/contact'])?>">Gift Finder</a>
        <div class="dropdown-menu" id="finder" aria-labelledby="gift-finder-item">
          <div class="container">
            <div class="row mx-auto my-4">
              <div class="col-md-2 col-3">
                <h3>For:</h3>
              </div>
              <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="valentine" />
                  <label class="custom-control-label" for="customSwitches">Valentine's</label>
                </div>
              </div>
              <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="her" />
                  <label class="custom-control-label" for="customSwitches">Her</label>
                </div>
              </div>
              <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="him" />
                  <label class="custom-control-label" for="customSwitches">Him</label>
                </div>
              </div>
              <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="home" />
                  <label class="custom-control-label" for="customSwitches">Home</label>
                </div>
              </div>
            </div>
            <div class="row mx-auto my-4">
              <div class="col-md-2 col-3">
                <h3>Rose type:</h3>
              </div>
              <div class="col-md-2 col-3 mx-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="him" />
                  <label class="custom-control-label" for="customSwitches">Fresh ( Classic )</label>
                </div>
              </div>
              <div class="col-md-3 col-3 mx-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="home" />
                  <label class="custom-control-label" for="customSwitches">Long lasting roses ( Infinity )</label>
                </div>
              </div>
              <div class="col-md-1 col-0 mx-auto"></div>
              <div class="col-md-2 col-0 mx-auto"></div>
            </div>
            <div class="row mx-auto my-4">
              <div class="col-md-2 col-3">
                <h3>Price:</h3>
              </div>
              <div class="col-md-10 col-12 mx-auto">
                <input type="text" class="span2" value="" data-slider-tooltip="show" data-slider-min="0"
                  data-slider-max="1000" data-slider-step="5" data-slider-value="[0,1000]" id="dp5">
                <div class="row">
                  <div class="col-6 text-left pl-1">
                    <span class="price min">123</span>
                  </div>
                  <div class="col-6 text-right pr-1">
                    <span class="price max">123</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center my-4">
              <button class="btn btn-outline-gold">Find Roses!</button>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item drop-item">
        <a class="nav-link" href="<?= Url::to(['site/category', 'id' => $cat->id]);?>" id="fresh-roses-dropdown" data-target="fresh-roses">Fresh Roses</a>
        <div class="dropdown-menu" role="menu" aria-labelledby="fresh-roses-dropdown">
          <div class="container">
            <div class="row mb-5 mt-4 content">
              <div class="col-lg-3 col-md-4 offset-lg-1">
                <ul class="list-unstyled">
                  <li>
                    <a href="#" data-image="">Classic Rose Stems</a>
                  </li>
                  <li>
                    <a href="#" data-image="">Classic Rose Gesture</a>
                  </li>
                  <li>
                    <a href="#" data-image="">Classic Rose Waldorf</a>
                  </li>
                  <li>
                    <a href="#" data-image="">Classic Rose Silver Cube</a>
                  </li>
                  <li>
                    <a href="#" data-image="">
                      Classic Rose Black Cube</a>
                  </li>
                  <li>
                    <a href="#" data-image=""> The Only Bouquet</a>
                  </li>
                  <li>
                    <a href="#" data-image="">
                      The Beverly Hills Collection</a>
                  </li>
                  <li>
                    <a href="#" data-image=""> Classic Rose Soho</a>
                  </li>
                  <li>
                    <a href="#" data-image=""> Classic Rose Plaza</a>
                  </li>
                  <li>
                    <a href="#" data-image=""> Classic Rose Verano</a>
                  </li>
                  <li>
                    <a href="#" data-image="">
                      Classic Rose Manhattan</a>
                  </li>
                  <li>
                    <a href="#" data-image=""> Classic Rose Heart</a>
                  </li>
                  <li>
                    <a href="#" data-image="">
                      Classic Rose Boulevard</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-4 col-md-4 img-preview mx-auto">
                <img src="/img/product/3.jpg" alt="" />
              </div>
              <div class="col-lg-3 col-md-4 offset-lg-1 px-0 drop-desc">
                <h6>What are classic roses?</h6>
                <p class="description">
                  Classic Roses are the World’s finest, fresh-cut,
                  Ecuadorian roses. If cared for correctly, Classic Roses
                  will last at least 5 days, often longer
                </p>
              </div>
            </div>
            <hr />
            <div class="row cats">
              <div class="col-lg-3 col-md-6">
                <a href="">
                  <h5>All classic roses</h5>
                </a>
              </div>
              <div class="col-lg-3 col-md-6">
                <a href="">
                  <h5>Roses for delivery</h5>
                </a>
              </div>
              <div class="col-lg-3 col-md-6">
                <a href="">
                  <h5>Roses for business</h5>
                </a>
              </div>
              <div class="col-lg-3 col-md-6">
                <a href="">
                  <h5>Lilac luxiries</h5>
                </a>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item drop-item">
        <a class="nav-link" href="<?= Url::to(['site/category', 'id' => $cat->id]);?>" data-target="infinty-roses-item">Infinity Roses</a>
        <div class="dropdown-menu" aria-labelledby="infinty-roses-item">
          <div class="container">
            <div class="row mb-5 mt-4 content">
              <div class="col-lg-3 col-md-4 offset-lg-1">
                <ul class="list-unstyled">
                  <li>
                    <a href="#" data-image=""> Infinite Statement Rose</a>
                  </li>
                  <li>
                    <a href="#" data-image=""> Infinite Rose Ebony</a>
                  </li>
                  <li><a href="#" data-image=""> The Infinite Rose®</a></li>
                  <li>
                    <a href="#" data-image=""> Infinite Rose Blanc</a>
                  </li>
                  <li>
                    <a href="#" data-image=""> Infinite Rose Quartet</a>
                  </li>
                  <li><a href="#" data-image=""> Infinite Rose Luna</a></li>
                  <li>
                    <a href="#" data-image=""> Infinite Rose Fortune</a>
                  </li>
                  <li><a href="#" data-image=""> Infinite Rose Gem</a></li>
                  <li>
                    <a href="#" data-image=""> Infinite Rose Plaza</a>
                  </li>
                  <li>
                    <a href="#" data-image=""> Infinite Rose Waldorf</a>
                  </li>
                  <li>
                    <a href="#" data-image=""> Infinite Rose Black Cube</a>
                  </li>
                  <li><a href="#" data-image=""> Infinite Rose Soho</a></li>
                  <li>
                    <a href="#" data-image=""> Infinite Rose Silver Cube</a>
                  </li>
                  <li>
                    <a href="#" data-image=""> Infinite Rose Jewel</a>
                  </li>
                  <li>
                    <a href="#" data-image=""> Infinite Rose Heart</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-4 col-md-4 img-preview mx-auto">
                <img src="/img/product/5.jpg" alt="" />
              </div>
              <div class="col-lg-3 col-md-4 offset-lg-1 px-0 drop-desc">
                <h6>What are infinity roses?</h6>
                <p class="description">
                  Infinite Roses are real roses, that last up to a year,
                  without any water. They cannot be told apart from their
                  fresh-cut counterparts.
                </p>
              </div>
            </div>
            <hr />
            <div class="row cats">
              <div class="col-lg-3 col-md-6">
                <a href="">
                  <h5>All infinity roses</h5>
                </a>
              </div>
              <div class="col-lg-3 col-md-6">
                <a href="">
                  <h5>Roses for delivery</h5>
                </a>
              </div>
              <div class="col-lg-3 col-md-6">
                <a href="">
                  <h5>Roses for business</h5>
                </a>
              </div>
              <div class="col-lg-3 col-md-6">
                <a href="">
                  <h5>Lilac luxiries</h5>
                </a>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item drop-item">
        <a class="nav-link" href="<?= Url::to(['site/category', 'id' => $cat->id]);?>" role="button" id="luxuty-roses-item" aria-haspopup="true"
          aria-expanded="false">The
          Luxury Collection</a>
        <div class="dropdown-menu" aria-labelledby="luxuty-roses-item">
          <div class="container">
            <div class="row mb-5 mt-4 content">
              <div class="col-lg-2 col-md-4">
                <h6>The classic luxury collection</h6>
                <ul class="list-unstyled">
                  <div class="row">
                    <div class="col-lg-12 col-6">
                      <li>
                        <a href="#" data-image="">Classic Rose Stems</a>
                      </li>
                      <li>
                        <a href="#" data-image="">Classic Rose Gesture</a>
                      </li>
                      <li>
                        <a href="#" data-image="">Classic Rose Waldorf</a>
                      </li>
                      <li>
                        <a href="#" data-image="">Classic Rose Silver Cube</a>
                      </li>
                      <li>
                        <a href="#" data-image="">
                          Classic Rose Black Cube</a>
                      </li>
                      <li>
                        <a href="#" data-image=""> The Only Bouquet</a>
                      </li>
                      <li>
                        <a href="#" data-image="">
                          The Beverly Hills Collection</a>
                      </li>
                    </div>
                    <div class="col-lg-12 col-6">
                      <li>
                        <a href="#" data-image=""> Classic Rose Soho</a>
                      </li>
                      <li>
                        <a href="#" data-image=""> Classic Rose Plaza</a>
                      </li>
                      <li>
                        <a href="#" data-image=""> Classic Rose Verano</a>
                      </li>
                      <li>
                        <a href="#" data-image="">
                          Classic Rose Manhattan</a>
                      </li>
                      <li>
                        <a href="#" data-image=""> Classic Rose Heart</a>
                      </li>
                      <li>
                        <a href="#" data-image="">
                          Classic Rose Boulevard</a>
                      </li>
                    </div>
                  </div>
                </ul>
              </div>
              <div class="col-lg-2 col-md-4">
                <h6>The classic luxury collection</h6>
                <ul class="list-unstyled">
                  <div class="row">
                    <div class="col-lg-12 col-6">
                      <li>
                        <a href="#" data-image="">Classic Rose Stems</a>
                      </li>
                      <li>
                        <a href="#" data-image="">Classic Rose Gesture</a>
                      </li>
                      <li>
                        <a href="#" data-image="">Classic Rose Waldorf</a>
                      </li>
                      <li>
                        <a href="#" data-image="">Classic Rose Silver Cube</a>
                      </li>
                      <li>
                        <a href="#" data-image="">
                          Classic Rose Black Cube</a>
                      </li>
                      <li>
                        <a href="#" data-image=""> The Only Bouquet</a>
                      </li>
                      <li>
                        <a href="#" data-image="">
                          The Beverly Hills Collection</a>
                      </li>
                    </div>
                    <div class="col-lg-12 col-6">
                      <li>
                        <a href="#" data-image=""> Classic Rose Soho</a>
                      </li>
                      <li>
                        <a href="#" data-image=""> Classic Rose Plaza</a>
                      </li>
                      <li>
                        <a href="#" data-image=""> Classic Rose Verano</a>
                      </li>
                      <li>
                        <a href="#" data-image="">
                          Classic Rose Manhattan</a>
                      </li>
                      <li>
                        <a href="#" data-image=""> Classic Rose Heart</a>
                      </li>
                      <li>
                        <a href="#" data-image="">
                          Classic Rose Boulevard</a>
                      </li>
                    </div>
                  </div>
                </ul>
              </div>
              <div class="col-lg-4 col-md-4 img-preview mx-auto">
                <img src="/img/product/7.jpg" alt="" />
              </div>
              <div class="col-lg-3 col-md-4 px-0 drop-desc">
                <h6>What are infinity roses?</h6>
                <p class="description">
                  Infinite Roses are real roses, that last up to a year,
                  without any water. They cannot be told apart from their
                  fresh-cut counterparts.
                </p>
              </div>
            </div>
            <hr />
            <div class="row cats">
              <div class="col-lg-3 col-md-6">
                <a href="">
                  <h5>All infinity roses</h5>
                </a>
              </div>
              <div class="col-lg-3 col-md-6">
                <a href="">
                  <h5>Roses for delivery</h5>
                </a>
              </div>
              <div class="col-lg-3 col-md-6">
                <a href="">
                  <h5>Roses for business</h5>
                </a>
              </div>
              <div class="col-lg-3 col-md-6">
                <a href="">
                  <h5>Lilac luxiries</h5>
                </a>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= Url::to(['site/contact'])?>">Contact Us</a>
      </li>
      <li class="nav-item icon-item">
        <a href="" class="nav-link" data-toggle="modal" data-target="#search"><i class="fas fa-search"></i></a>
      </li>
      <li class="nav-item icon-item">
        <a href="" class="nav-link" class="nav-link" data-toggle="modal" data-target="#langModal"><i class="fas fa-globe"></i></a>
      </li>
      <li class="nav-item icon-item">
        <a href="" class="nav-link" data-toggle="modal" data-target="#cart-modal"><i class="fas fa-shopping-cart"></i></a>
      </li>
      <li class="nav-item icon-item">
        <a href="<?= Url::to(['site/login'])?>" class="nav-link"><i class="fas fa-user"></i></a>
      </li>
    </ul>
  </div>
</nav>

<!-- Modal search -->
<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="search" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="search">
          Search in Infinity-roses
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body gold-form">
        <form action="">
          <div class="btn-group w-100">
            <input type="text" class="form-control mb-0" placeholder="What do you want to find?" />
            <button type="button" class="btn btn-outline-gold">
              Find!
            </button>
          </div>
        </form>
        <ul class="list-unstyled auto-complete mt-3 ml-3">
          <li>Lorem ipsum dolor sit.</li>
          <li>Lorem ipsum dolor sit.</li>
          <li>Lorem ipsum dolor sit.</li>
          <li>Lorem ipsum dolor sit.</li>
          <li>Lorem ipsum dolor sit.</li>
        </ul>
      </div>
      <div class="modal-footer">
        <p class="mx-auto">or use <a href="">Gift finder</a></p>
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
            <a href=""><img src="/img/langs/eng.png" alt="" width="30">English</a>
          </div>
          <div class="col-6 mx-auto">
            <a href=""><img src="/img/langs/ru.png" alt="" width="30">Русский</a>
          </div>
        </div>
        <a style="cursor: pointer" class="my-3" data-dismiss="modal" aria-label="Close">Close</a>
      </div>
    </div>
  </div>
</div>


<!-- navbar end -->

<?= $content?>

<!-- cart modal -->

<div class="modal fade cart-style" id="cart-modal" tabindex="-1" role="dialog" aria-labelledby="cart-modal"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          Your Cart
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body gold-form">
        <table class="table">
          <thead>
            <tr>
              <th>Photo</th>
              <th>Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Sum</th>
              <th><i class="fas fa-times"></i></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><img src="/img/product/4.jpg" alt="" class="img-prod"></td>
              <td>Test</td>
              <td>3</td>
              <td>$1500</td>
              <td>$4500</td>
              <td><i class="fas fa-times"></i></td>
            </tr>
            <tr>
              <td><img src="/img/product/5.jpg" alt="" class="img-prod"></td>
              <td>Test</td>
              <td>3</td>
              <td>$1500</td>
              <td>$4500</td>
              <td><i class="fas fa-times"></i></td>
            </tr>
            <tr>
              <td><img src="/img/product/6.jpg" alt="" class="img-prod"></td>
              <td>Test</td>
              <td>3</td>
              <td>$1500</td>
              <td>$4500</td>
              <td><i class="fas fa-times"></i></td>
            </tr>
            <tr>
              <td colspan="5">Common quantity: </td>
              <td width="50">9</td>
            </tr>
            <tr>
              <td colspan="5">Common sum: </td>
              <td>$13500</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" aria-label="Close" class="btn btn-outline-gold">Continue shopping</button>
        <a href="<?= Url::to(['cart/view']);?>" class="btn btn-outline-success">Formalize the order</a>
        <button class="btn btn-outline-danger">Clear the cart</button>
      </div>
    </div>
  </div>
</div>

  <!-- footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 py-4">
          <h2>Location:</h2>
          <p>9631 Brighton Way Beverly Hills Los Angeles, CA - 90210</p>
        </div>
        <div class="col-lg-3 col-md-6 py-4">
          <h2>Contacts:</h2>
          <p>
            +9989 99 111 11 11 <br />
            +9989 90 111 11 11
          </p>
        </div>
        <div class="col-lg-3 col-md-6 py-4">
          <h2>Follow Us:</h2>
          <a href="#"> <i class="fab fa-facebook-square"></i> </a>
          <a href="#"> <i class="fas fa-camera-retro"></i> </a>
          <a href="#"> <i class="fab fa-skype"></i> </a>
          <a href="#"> <i class="fab fa-pinterest-square"></i> </a>
          <p>
            Follow us and be aware <br />
            of all news
          </p>
        </div>
        <div class="col-lg-3 col-md-6 py-4">
          <h2>Customers service:</h2>
          <a href="#">Retrieve My Cart</a> <br />
          <a href="#">Terms Of Use</a> <br />
          <a href="#">Privacy</a> <br />
          <a href="#">FAQ (Frequently Asked Questions)</a> <br />
          <a href="#">Events</a> <br />
        </div>
      </div>
      <hr />
      <p class="text-center mb-0">www.infinity-roses.uz</p>
    </div>
  </footer>
  
  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>