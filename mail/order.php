<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<img src="<?= Url::base(true) . '/web/img/mail-header.jpg';?>" alt="">
<table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
    <thead>
    <tr style="background: #f9f9f9;">
        <th style="padding: 8px; border: 1px solid #ddd;"><?= Yii::t('app', 'Product name')?></th>
        <th style="padding: 8px; border: 1px solid #ddd;"><?= Yii::t('app', 'Size')?></th>
        <th style="padding: 8px; border: 1px solid #ddd;"><?= Yii::t('app', 'Price')?></th>
        <th style="padding: 8px; border: 1px solid #ddd;"><?= Yii::t('app', 'Quantity')?></th>
        <th style="padding: 8px; border: 1px solid #ddd;"><?= Yii::t('app', 'Parfume')?></th>
        <th style="padding: 8px; border: 1px solid #ddd;"><?= Yii::t('app', 'Chocolate')?></th>
        <th style="padding: 8px; border: 1px solid #ddd;"><?= Yii::t('app', 'Vase')?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($session['cart'] as $id => $item):?>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['name']?></td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['size']?></td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['price'] / 1000 >= 1000 ? $item['price'] / 1000000 . 'M' : $item['price'] / 1000 . 'K';?> <?= Yii::t('app', 'sum')?></td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['qty']?></td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['parfume'] ? $item['parfume'] : '--'?></td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['chocolate'] ? $item['chocolate'] : '--'?></td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?php
                if ($item['vase'] == 'true') {
                    echo 'Yes';
                } else {
                    echo '--';
                }
            ?></td>
        </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="6" style="padding: 8px; border: 1px solid #ddd;">Common sum: </td>
        <td style="padding: 8px; border: 1px solid #ddd;"><?= $session['cart.sum'] / 1000 >= 1000 ? $session['cart.sum'] / 1000000 . 'M' : $session['cart.sum'] / 1000 . 'K';?> <?= Yii::t('app', 'sum')?></td>
    </tr>
    <tr>
        <td colspan="6" style="padding: 8px; border: 1px solid #ddd;">Common quantity: </td>
        <td style="padding: 8px; border: 1px solid #ddd;"><?= $session['cart.qty']?></td>
    </tr>
    </tbody>
</table>