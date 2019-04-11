<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<section id="not-found">
	<h2 class="prata fsize_h1"><?= Html::encode($this->title) ?></h2>
	<p> <?= nl2br(Html::encode($message)) ?></p>
	<a href="/" class="btn btn-outline-dark"><?= Yii::t('app', 'Main page')?></a>
</section>