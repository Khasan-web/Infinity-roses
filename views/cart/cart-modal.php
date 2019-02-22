<?php if (!empty($session['cart'])): ?>

<table class="table">
    <thead>
    <tr>
        <th>Photo</th>
        <th>Name</th>
        <th>Size</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Parfume</th>
        <th>Chocolate</th>
        <th><i class="fas fa-times"></i></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($session['cart'] as $id => $item):?>
        <tr>
            <td><img class="img-prod" src="web/img/product/<?= $item['img']?>" alt="<?= $item['name']?>"></td>
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
        <td colspan="7">Common sum: </td>
        <td>$<?= $session['cart.sum']?></td>
    </tr>
    <tr>
        <td colspan="7">Common quantity: </td>
        <td><?= $session['cart.qty']?></td>
    </tr>
    </tbody>
</table>

<?php else:?>
<h2 class="not-found text-center">Cart is empty...</h2>

<?php endif;?>