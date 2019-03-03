<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Events */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= AdminTitle::widget(['title' => Html::encode($this->title), 'breadcrumbs' => $this->params['breadcrumbs']])?>
<?php
    $image = $model->getImage();
?>
<div class="events-view page-content" data-id="<?= $model->id?>" data-image="<?= $image->urlAlias?>">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
            <?= Yii::$app->session->getFlash('success')?>
        </div>
    <?php endif;?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissable">
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
            'name',
            'date_from',
            'date_to',
            'description_en:html',
            'description_ru:html',
            // 'image',
            [
                'attribute' => 'image',
                'value' => "<img src='{$image->getUrl('200x')}'>",
                'format' => 'html',
                'contentOptions' => ['style' => 'width: 70%'],
            ],
        ],
    ]) ?>

</div>
