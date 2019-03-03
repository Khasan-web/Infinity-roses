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

    <?php 
        $image = $model->getImage();
        $gallery = $model->getImages();
    ?>

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
            // 'description_en:html',
            [
                'attribute' => 'description_en',
                'value' => $model->description_en,
                'format' => 'html',
                'contentOptions' => ['class' => 'description'],
            ],
            'description_ru:html',
            // 'img',
            [
                'attribute' => 'img',
                'value' => "<img src='{$image->getUrl('80x')}'></img>",
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

    <hr>
    <h3>Gallery</h3>

    <?php
    
    foreach($gallery as $file){
        echo "<img src='{$file->getUrl('80x')}'></img>";
    }

    ?>

</div>
