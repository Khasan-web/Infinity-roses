<?php foreach ($pricesModel as $size):?>
    <li data-id="<?= $size->id?>">
    <i class="fa fa-times remove-size" style="margin: 0 5px;" onclick="confirm('Delete <?= $size->size?>?')"></i>
    <?= $size->size . ' | ' . $size->price . ' sum'?>
    </li>
<?php endforeach;?>