<?php foreach ($imagesToAjax as $image):?>
<?php
    $color_split = str_split($image->name);
    $color_name = '';
    $image_position = '';
    foreach ($color_split as $char) {
        $char = strtolower($char);
        if (preg_match('/[a-z]+/', $char)) {
            $color_name .= $char;
        }
        if (preg_match('/[0-9]/', $char)) {
            $image_position = $char;
        }
    }
?>
<div class="col-3 color">
    <img src="<?= $image->getUrl()?>" alt="<?= $color_name?>" data-position="<?= $image_position?>"
        data-color="<?= $color_name?>">
    <span><?= $color_name?></span>
</div>
<?php endforeach;?>