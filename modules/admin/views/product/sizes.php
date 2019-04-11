<?php foreach ($pricesModel as $size):?>
<li data-id="<?= $size->id?>"><i class="fa fa-times remove-size" style="margin: 0 5px;"></i><?= $size->size . ' ' . "($size->height cm H x $size->width cm W)" . ' | ' . $size->price . ' sum'?></li>
<?php endforeach;?>