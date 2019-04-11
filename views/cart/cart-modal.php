<?php if (!empty($session['cart'])): ?>

<div class="table-responsive">
<table class="table">
    <thead>
    <tr>
        <th><?= Yii::t('app', 'Photo')?></th>
        <th><?= Yii::t('app', 'Product name')?></th>
        <th><?= Yii::t('app', 'Size')?></th>
        <th><?= Yii::t('app', 'Price')?></th>
        <th class="hide-on-mob"><?= Yii::t('app', 'Quantity')?></th>
        <!-- <th><?php //echo Yii::t('app', 'Parfume')?></th>
        <th><?php //echo Yii::t('app', 'Chocolate')?></th> -->
        <th class="hide-on-mob"><?= Yii::t('app', 'Vase')?></th>
        <th><i class="fas fa-times"></i></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($session['cart'] as $item):?>
        <tr>
            <td><img class="img-prod" src="<?= $item['img']?>" alt="<?= $item['name']?>"></td>
            <td><?= $item['name']?></td>
            <td><?= $item['size']?></td>
            <td><?= $item['price'] . ' ' . Yii::t('app', 'sum')?></td>
            <td class="hide-on-mob"><?= $item['qty']?></td>
            <!-- <td><?php //echo $item['parfume'] ? $item['parfume'] : '--'?></td>
            <td><?php //echo $item['chocolate'] ? $item['chocolate'] : '--'?></td> -->
            <td class="hide-on-mob"><?php
                if ($item['vase'] == true) {
                    echo 'Yes';
                } else {
                    echo '--';
                }
            ?></td>
            <td><i class="fas fa-times del-item" data-id="<?= $item['id']?>"></i></td>
        </tr>
    <?php endforeach;?>

    <tr>
        <td class="pb-1 pt-4 colspan-mob" colspan="3"><?= Yii::t('app', 'Common sum:')?></td>
        <td colspan="4" class="text-right pb-1 pt-4"><?= $session['cart.sum'] . ' ' . Yii::t('app', 'sum')?></td>
    </tr>
    <tr>
        <td class="py-1 colspan-mob" colspan="3"><?= Yii::t('app', 'Common quantity:')?></td>
        <td colspan="4" class="text-right py-1"><?= $session['cart.qty']?></td>
    </tr>
    </tbody>
</table>
</div>

<?php else:?>
<h2 class="not-found text-center"><?= Yii::t('app', 'Cart is empty')?>...</h2>

<?php endif;?>