<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\modules\admin\assets\AdminAsset;
use yii\helpers\Url;
use app\components\Navbar;
use app\components\AdminNotification;
use app\models\User;

$user = User::find()->one();
$image = $user->getImage();

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCsrfMetaTags() ?>
    <link rel="shortcut icon" href="images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <title><?= Html::encode($this->title)?> | Admin</title>
  <?php $this->head() ?>
</head>
<body style="overflow-x: hidden;">
<?php $this->beginBody() ?>

    <!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!--END BACK TO TOP--><!--BEGIN TOPBAR-->
    <div id="header-topbar-option-demo" class="page-header-topbar">
        <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" data-intro="&lt;b&gt;Topbar&lt;/b&gt; has other styles with live demo. Go to &lt;b&gt;Layouts-&gt;Header&amp;Topbar&lt;/b&gt; and check it out." class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="<?= Url::to(['/admin'])?>" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">Infinity roses</span><span style="display: none" class="logo-text-icon">µ</span></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                <form id="topbar-search" action="" method="" class="hidden-sm hidden-xs">
                    <div class="input-icon right"><a href="#"><i class="fa fa-search"></i></a><input type="text" placeholder="Search here..." class="form-control"/></div>
                </form>
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                    <?= AdminNotification::widget();?>
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img src="<?= $image->getUrl('45x45')?>" alt="" class="img-responsive img-circle"/>&nbsp;<span class="hidden-xs"><?= $user->username?></span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="<?= Url::to(['profile'])?>"><i class="fa fa-user"></i>My Profile</a></li>
                            <li><a target="_blank" href="https://calendar.google.com/calendar"><i class="fa fa-calendar"></i>Calendar</a></li>
                            <li><a target="_blank" href="https://mail.google.com"><i class="fa fa-envelope"></i>Inbox</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= Url::to(['/site/logout'])?>"><i class="fa fa-key"></i>Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!--END TOPBAR-->
    <div id="wrapper"><!--BEGIN SIDEBAR MENU-->
        <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;" data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                    <li class="user-panel">
                        <div class="thumb"><img src="<?= $image->getUrl('45x45')?>" alt="" class="img-circle"/></div>
                        <div class="info"><p><?= $user->username?></p>
                            <ul class="list-inline list-unstyled">
                                <li><a href="<?= Url::to(['profile'])?>"><i class="fa fa-user"></i></a></li>
                                <li><a target="_blank" href="https://mail.google.com/" data-hover="tooltip" title="Mail"><i class="fa fa-envelope"></i></a></li>
                                <li><a href="<?= Url::to(['/site/index'])?>" data-hover="tooltip"><i class="fa fa-home"></i></a></li>
                                <li><a href="<?= Url::to(['/site/logout'])?>" data-hover="tooltip" title="Logout"><i class="fa fa-sign-out"></i></a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li class="active"><a href="<?= Url::to(['/admin'])?>"><i class="fa fa-tachometer fa-fw">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Dashboard</span></a></li>
                    <li><a href="#"><i class="fa fa-th-list fa-fw">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Products</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        <li><a href="<?= Url::to(['product/'])?>"><span class="submenu-title"><i class="fa fa-ellipsis-v" aria-hidden="true"></i> List of products</span></a></li>
                            <li><a href="<?= Url::to(['product/create'])?>"><span class="submenu-title"><i class="fa fa-plus" aria-hidden="true"></i> Add a product</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-dropbox fa-fw">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Categories</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?= Url::to(['category/'])?>"><span class="submenu-title"><i class="fa fa-ellipsis-v" aria-hidden="true"></i> List of collections</span></a></li>
                            <li><a href="<?= Url::to(['category/create'])?>"><span class="submenu-title"><i class="fa fa-plus" aria-hidden="true"></i> Add an collection</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-users">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Orders</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?= Url::to(['order/'])?>"><span class="submenu-title"><i class="fa fa-ellipsis-v" aria-hidden="true"></i> List of orders</span></a></li>
                            <li><a href="<?= Url::to(['order/create'])?>"><span class="submenu-title"><i class="fa fa-plus" aria-hidden="true"></i> Create an order</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-calendar fa-fw">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Events</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        <li><a href="<?= Url::to(['events/'])?>"><span class="submenu-title"><i class="fa fa-ellipsis-v" aria-hidden="true"></i> List of events</span></a></li>
                            <li><a href="<?= Url::to(['events/create'])?>"><span class="submenu-title"><i class="fa fa-plus" aria-hidden="true"></i> Add an event</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!--END SIDEBAR MENU--><!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <?= $content?>
            <!--BEGIN FOOTER-->
            <div id="footer">
                <div class="copyright">Infinity Roses | Admin Panel</div>
            </div>
            <!--END FOOTER-->
        </div>
        <!--END PAGE WRAPPER-->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>