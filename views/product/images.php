<?php foreach ($imagesToAjax as $image):?>
<?php
    $img_info = explode('_', $image->name);
    $color_name = '';
    $image_position = '';
    $color_name = $img_info[0];
    $image_position = $img_info[1];
?>

<div class="col-3 color">
    <img src="<?= $image->getUrl()?>" alt="<?= $color_name?>" data-position="<?= $image_position?>"
        data-color="<?= $color_name?>">
    <span><?= $color_name?></span>
</div>

<?php endforeach;?>
