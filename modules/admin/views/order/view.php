<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\AdminTitle;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '№' . $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= AdminTitle::widget(['title' => 'Order №' . $this->title, 'breadcrumbs' => $this->params['breadcrumbs']])?>
<div class="order-view page-content">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
            <?= Yii::$app->session->getFlash('success')?>
        </div>
    <?php endif;?>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'qty',
            // 'sum',
            [
                'attribute' => 'sum',
                'value' => '$' .$model->sum,
            ],
            // 'status',
            [
                'attribute' => 'status',
                'value' => $model->status ? '<span class="label label-sm label-success">Checked</span>' : '<span class="label label-sm label-warning">Active</span>',
                'format' => 'html',
            ],
            'name',
            'email:email',
            'phone',
            'address',
        ],
    ]) ?>

    <hr>

    <?php $items = $model->orderItems;?>
    <table class="table">
			<thead>
			<tr>
				<th>Name</th>
				<th>Size</th>
				<th>Price</th>
                <th>Color</th>
				<th>Quantity</th>
				<th>Parfume</th>
				<th>Chocolate</th>
				<th>Sum</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($items as $item):?>
				<tr>
					<td><a style="text-decoration: underline" href="<?= Url::to(['product/view', 'id' => $item['product_id']])?>"><?= $item['name']?></a></td>
					<td><?= $item['size']?></td>
					<td>$<?= $item['price']?></td>
                    <td><?= $item['color']?></td>
					<td><?= $item['qty_item']?></td>
					<td><?= $item['parfume']?></td>
					<td><?= $item['chocolate']?></td>
					<td>$<?= $item['sum_item']?></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>

</div>