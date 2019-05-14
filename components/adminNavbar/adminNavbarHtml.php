<?php

use yii\helpers\Url;

?>

<li class="<?= $this->home?>"><a href="<?= Url::to(['/admin'])?>"><i class="fa fa-tachometer fa-fw">
    <div class="icon-bg bg-orange"></div>
</i><span class="menu-title">Dashboard</span></a></li>
<li class="<?= $this->products?>"><a href="#"><i class="fa fa-th-list fa-fw">
    <div class="icon-bg bg-violet"></div>
</i><span class="menu-title">Products</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
    <li><a href="<?= Url::to(['product/'])?>"><span class="submenu-title"><i class="fa fa-ellipsis-v" aria-hidden="true"></i> List of products</span></a></li>
        <li><a href="<?= Url::to(['product/create'])?>"><span class="submenu-title"><i class="fa fa-plus" aria-hidden="true"></i> Add product</span></a></li>
    </ul>
</li>
<li class="<?= $this->categories?>"><a href="#"><i class="fa fa-dropbox fa-fw">
    <div class="icon-bg bg-green"></div>
</i><span class="menu-title">Categories</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li><a href="<?= Url::to(['category/'])?>"><span class="submenu-title"><i class="fa fa-ellipsis-v" aria-hidden="true"></i> List of collections</span></a></li>
        <li><a href="<?= Url::to(['category/create'])?>"><span class="submenu-title"><i class="fa fa-plus" aria-hidden="true"></i> Add collection</span></a></li>
    </ul>
</li>
<li class="<?= $this->orders?>"><a href="#"><i class="fa fa-users">
    <div class="icon-bg bg-pink"></div>
</i><span class="menu-title">Orders</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li><a href="<?= Url::to(['order/'])?>"><span class="submenu-title"><i class="fa fa-ellipsis-v" aria-hidden="true"></i> List of orders</span></a></li>
        <li><a href="<?= Url::to(['order/create'])?>"><span class="submenu-title"><i class="fa fa-plus" aria-hidden="true"></i> Create order</span></a></li>
    </ul>
</li>
<li class="<?= $this->events?>"><a href="#"><i class="fa fa-calendar fa-fw">
    <div class="icon-bg bg-violet"></div>
</i><span class="menu-title">Events</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
    <li><a href="<?= Url::to(['events/'])?>"><span class="submenu-title"><i class="fa fa-ellipsis-v" aria-hidden="true"></i> List of events</span></a></li>
        <li><a href="<?= Url::to(['events/create'])?>"><span class="submenu-title"><i class="fa fa-plus" aria-hidden="true"></i> Add event</span></a></li>
    </ul>
</li>
<li class="<?= $this->gallery?>"><a href="#"><i class="fa fa-file-image-o">
    <div class="icon-bg bg-violet"></div>
</i><span class="menu-title">Gallery</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
    <li><a href="<?= Url::to(['gallery/'])?>"><span class="submenu-title"><i class="fa fa-ellipsis-v" aria-hidden="true"></i> Gallery</span></a></li>
        <li><a href="<?= Url::to(['gallery/create'])?>"><span class="submenu-title"><i class="fa fa-plus" aria-hidden="true"></i> Add new images</span></a></li>
    </ul>
</li>
<li class="<?= $this->background?>"><a href="#"><i class="fa fa-image fa-fw">
    <div class="icon-bg bg-violet"></div>
</i><span class="menu-title">Background</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
    <li><a href="<?= Url::to(['background/'])?>"><span class="submenu-title"><i class="fa fa-ellipsis-v" aria-hidden="true"></i> Backgrounds</span></a></li>
        <li><a href="<?= Url::to(['background/create'])?>"><span class="submenu-title"><i class="fa fa-plus" aria-hidden="true"></i> Add a new background</span></a></li>
    </ul>
</li>
<li class="<?= $this->color?>"><a href="#"><i class="fa fa-eye fa-fw">
    <div class="icon-bg bg-violet"></div>
</i><span class="menu-title">Color</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
    <li><a href="<?= Url::to(['color/'])?>"><span class="submenu-title"><i class="fa fa-ellipsis-v" aria-hidden="true"></i> List of Colors</span></a></li>
        <li><a href="<?= Url::to(['color/create'])?>"><span class="submenu-title"><i class="fa fa-plus" aria-hidden="true"></i> Add a new color</span></a></li>
    </ul>
</li>