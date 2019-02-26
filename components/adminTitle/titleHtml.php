<?php

use yii\helpers\Url;

?>

<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title"><?= $this->title?></div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
    <?php if ($this->breadcrumbs):?>
    <?php //debug($this->breadcrumbs); die;?>
        <?php if (count($this->breadcrumbs) >= 2):?>
            <?php foreach ($this->breadcrumbs as $crumb):?>
                <li class="active">
                        <?php if (isset($crumb['url'])):?>
                        <a href="
                            <?= Url::to(["{$crumb['url'][0]}", 'id' => $crumb['url']['id']])?>
                        ">
                        <?php endif;?>
                        <?php if (is_array($crumb)):?>
                            <?= $crumb['label']?>
                        <?php else:?>
                            <?= $crumb?>
                        <?php endif;?>
                    </a>
                    <?php if ($crumb != end($this->breadcrumbs)):?>
                        &nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    <?php endif;?>
                </li>
            <?php endforeach;?>
        <?php else:?>
            <li class="active">
                <?php if (isset($this->breadcrumbs['url'])):?>
                    <a href="
                        <?= Url::to(["{$this->breadcrumbs['url'][0]}", 'id' => $this->breadcrumbs['url']['id']])?>
                    ">
                    <?php endif;?>
                    <?php if (is_array($this->breadcrumbs)):?>
                        <?= $this->breadcrumbs['label']?>
                    <?php else:?>
                        <?= $this->breadcrumbs?>
                    <?php endif;?>
                </a>
                <?php if ($crumb != end($this->breadcrumbs)):?>
                    &nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                <?php endif;?>
            </li>
        <?php endif;?>
    <?php endif;?>
    </ol>
    <div class="clearfix"></div>
</div>