<?php if (!empty($session['cart'])): ?>

<table class="table">
    <thead>
    <tr>
        <th><?= Yii::t('app', 'Photo')?></th>
        <th><?= Yii::t('app', 'Product name')?></th>
        <th><?= Yii::t('app', 'Size')?></th>
        <th><?= Yii::t('app', 'Price')?></th>
        <th><?= Yii::t('app', 'Quantity')?></th>
        <th><?= Yii::t('app', 'Parfume')?></th>
        <th><?= Yii::t('app', 'Chocolate')?></th>
        <th><i class="fas fa-times"></i></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($session['cart'] as $item):?>
        <tr>
            <td><img class="img-prod" src="<?= $item['img']?>" alt="<?= $item['name']?>"></td>
            <td><?= $item['name']?></td>
            <td><?= $item['size']?></td>
            <td>$<?= $item['price']?></td>
            <td><?= $item['qty']?></td>
            <td>
                <?= $item['parfume']?>
            </td>
            <td><?= $item['chocolate']?></td>
            <td><i class="fas fa-times del-item" data-id="<?= $item['id']?>"></i></td>
        </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="7"><?= Yii::t('app', 'Common sum:')?></td>
        <td>$<?= $session['cart.sum']?></td>
    </tr>
    <tr>
        <td colspan="7"><?= Yii::t('app', 'Common quantity:')?></td>
        <td><?= $session['cart.qty']?></td>
    </tr>
    </tbody>
</table>

<?php else:?>
<h2 class="not-found text-center"><?= Yii::t('app', 'Cart is empty')?>...</h2>

<?php endif;?>