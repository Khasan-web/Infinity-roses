<?php

use yii\helpers\Url;

?>

<!-- navbar -->
<div class="brand text-center py-3 <?= $bg?>" id="nav-brand">
  <a href=""><img src="/img/main-logo.svg" class="wow fadeIn" width="120px" alt=""></a>
</div>
<nav class="navbar navbar-expand-lg w-100 p-0 <?= $this->bg?>">
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
      <a href="/login.html"><i class="fas fa-user"></i></a>
    </span>
  </div>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item drop-item" role="button" id="gift-finder-item" aria-haspopup="true" aria-expanded="false">
        <a class="nav-link" href="/contact.html">Gift Finder</a>
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
        <a class="nav-link" href="/contact.html" id="fresh-roses-dropdown" data-target="fresh-roses">Fresh Roses</a>
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
        <a class="nav-link" href="/contact.html" role="button" id="luxuty-roses-item" aria-haspopup="true"
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
        <a class="nav-link" href="/contact.html">Contact Us</a>
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
        <a href="/login.html" class="nav-link"><i class="fas fa-user"></i></a>
      </li>
    </ul>
  </div>
</nav>