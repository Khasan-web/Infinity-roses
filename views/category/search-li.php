<?php

use yii\helpers\Url;

?>

<?php foreach ($products as $product):?>
    <li>
        <a style="font-weight: 300; text-decoration: underline; color: #b89c64;" href="<?= Url::to(['product/view', 'id' => $product->id])?>"><?= $product->name?></a>
    </li>
<?php endforeach;?>