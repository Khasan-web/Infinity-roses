<?php

use yii\helpers\Html;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = Yii::t('app', 'Update Product: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ["view?id=$model->id"]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?= AdminTitle::widget(['title' => $this->title, 'breadcrumbs' => $this->params['breadcrumbs']])?>
<div class="product-update page-content">

    <?php if (Yii::$app->session->getFlash('update')):?>
        <div class="alert alert-warning">
            <?= Yii::$app->session->getFlash('update');?>
        </div>
    <?php endif;?>
    <?php if (Yii::$app->session->getFlash('add_sizes')):?>
        <div class="alert alert-warning">
            <?= Yii::$app->session->getFlash('add_sizes');?>
        </div>
    <?php endif;?>

    <?= $this->render('_form', [
        'model' => $model,
        'pricesModel' => $pricesModel,
        'colors' => $colors,
    ]) ?>

</div>
