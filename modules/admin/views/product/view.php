<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'View'];
\yii\web\YiiAsset::register($this);
?>
<?= AdminTitle::widget(['title' => Html::encode($this->title), 'breadcrumbs' => $this->params['breadcrumbs']])?>
<div class="product-view page-content">

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
            // 'category_id',
            [
                'attribute' => 'category_id',
                'value' => $model->category->name_en
            ],
            'name',
            // 'price',
            [
                'attribute' => 'price',
                'value' => '$' . $model->price,
                'contentOptions' => ['style' => 'width: 70%'],
            ],
            'keywords',
            'description:ntext',
            'description_ru:ntext',
            // 'img',
            [
                'attribute' => 'img',
                'value' => "<img width=\"80\" src=\"/img/product/{$model->img}\"></img>",
                'format' => 'html',
            ],
            // 'hit',
            [
                'attribute' => 'hit',
                'value' => !$model->hit ? '<span class="text-danger"><i class="fa fa-times"></i></span>' : '<span class="text-success"><i class="fa fa-check"></i></span>',
                'format' => 'html',
            ],
        ],
    ]) ?>

</div>
