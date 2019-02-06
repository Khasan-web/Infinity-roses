<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<section id="not-found">
	<h1><?= Html::encode($this->title) ?></h1>
	<p> <?= nl2br(Html::encode($message)) ?></p>
	<a href="/" class="btn btn-outline-dark">Go Main Page</a>
</section>