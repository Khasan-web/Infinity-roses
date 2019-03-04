<?php

use yii\helpers\Html;

?>
<?php
    $image = $event->getImage();
?>

<section id="about-company" style="padding-top: 0">
	<div class="event-img" style="background-image: url(<?= $image->getUrl()?>); position: relative">	
		<div class="basic-info">
			<h2><?= $event->name?></h2>
			<p><?= $event->date_from . ' | ' . $event->date_to?></p>
		</div>
	</div>
	<section id="info" style="padding-bottom: 0">
		<div class="container">
			<div class="col-md-10 mx-auto">
				<p><?= $event->$description?></p>
			</div>
		</div>
	</section>
</section>