<?php

use yii\base\Widget;
use app\components\AdminTitle;
use yii\helpers\Url;
use app\modules\admin\models\ProductSearch;

?>
<?= AdminTitle::widget(['title' => 'Dashboard', 'breadcrumbs' => ''])?>
<!--BEGIN CONTENT-->
<div class="page-content">
    <div id="sum_box" class="row mbl">
        <div class="col-sm-6 col-md-3">
            <a href="<?= Url::to(['product/'])?>">
                <div class="panel profit db mbm">
                    <div class="panel-body"><p class="icon"><i class="icon fa fa-shopping-cart"></i></p><h4 class="value">Products</h4>

                        <p class="description">Profit description</p>

                        <div class="progress progress-sm mbn">
                            <div role="progressbar" style="width: 100%" class="progress-bar progress-bar-success"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="<?= Url::to(['category/'])?>">
                <div class="panel income db mbm">
                    <div class="panel-body"><p class="icon"><i class="icon fa fa-bars"></i></p><h4 class="value">Categories</h4>

                        <p class="description">Income detail</p>

                        <div class="progress progress-sm mbn">
                            <div role="progressbar" style="width: 100%" class="progress-bar progress-bar-info"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="<?= Url::to(['order/'])?>">
                <div class="panel task db mbm">
                    <div class="panel-body"><p class="icon"><i class="icon fa fa-money"></i></p><h4 class="value">Orders</h4>

                        <p class="description">Task completed</p>

                        <div class="progress progress-sm mbn">
                            <div role="progressbar" style="width: 100%" class="progress-bar progress-bar-danger"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="<?= Url::to(['events/'])?>">
                <div class="panel visit db mbm">
                    <div class="panel-body"><p class="icon"><i class="icon fa fa-calendar"></i></p><h4 class="value">Events</h4>

                        <p class="description">Visitor description</p>

                        <div class="progress progress-sm mbn">
                            <div role="progressbar" style="width: 100%" class="progress-bar progress-bar-warning"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <hr>

    <h2>Helpful links</h2>
    <div class="row links">
        <div class="col-md-1 col-sm-3 col-xs-3">
            <a target="_blank" href="https://www.google.com/maps">
                <img src="/img/admin/google-map.png" alt="">
                <span>Google Map</span>
            </a>
        </div>
        <div class="col-md-1 col-sm-3 col-xs-3">
            <a target="_blank" href="https://analytics.google.com/analytics/web/provision/?authuser=0#/provision">
                <img src="/img/admin/analystic.png" alt="">
                <span>Analystic</span>
            </a>
        </div>
        <div class="col-md-1 col-sm-3 col-xs-3">
            <a target="_blank" href="https://calendar.google.com/calendar">
                <img src="/img/admin/calendar.png" alt="">
                <span>Calendar</span>
            </a>
        </div>
        <div class="col-md-1 col-sm-3 col-xs-3">
            <a target="_blank" href="https://mail.google.com">
                <img src="/img/admin/gmail.png" alt="">
                <span>Gmail</span>
            </a>
        </div>
    </div>

    <hr>
</div>