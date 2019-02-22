<table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
    <thead>
    <tr style="background: #f9f9f9;">
        <th style="padding: 8px; border: 1px solid #ddd;">Name</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Size</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Price</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Quantity</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Parfume</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Chocolate</th>
        <th style="padding: 8px; border: 1px solid #ddd;"><i class="fas fa-times"></i></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($session['cart'] as $id => $item):?>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['name']?></td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['size']?></td>
            <td style="padding: 8px; border: 1px solid #ddd;">$<?= $item['price']?></td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['qty']?></td>
            <td style="padding: 8px; border: 1px solid #ddd;">
                <?= $item['parfume']?>
            </td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['chocolate']?></td>
        </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="5" style="padding: 8px; border: 1px solid #ddd;">Common sum: </td>
        <td style="padding: 8px; border: 1px solid #ddd;">$<?= $session['cart.sum']?></td>
    </tr>
    <tr>
        <td colspan="5" style="padding: 8px; border: 1px solid #ddd;">Common quantity: </td>
        <td style="padding: 8px; border: 1px solid #ddd;"><?= $session['cart.qty']?></td>
    </tr>
    </tbody>
</table>