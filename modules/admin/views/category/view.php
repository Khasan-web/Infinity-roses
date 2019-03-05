<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */

$this->title = $model->name_en;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => 'View'];
\yii\web\YiiAsset::register($this);
?>
<?= AdminTitle::widget(['title' => $this->title, 'breadcrumbs' => $this->params['breadcrumbs']])?>
<div class="category-view page-content">

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
            'name_en',
            'name_ru',
            'description_en:ntext',
            'description_ru:ntext',
            'keywords',
        ],
    ]) ?>

</div>