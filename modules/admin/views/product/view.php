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
            [
                'attribute' => 'category_id',
                'value' => $model->category->name_en
            ],
            'name',
            'keywords',
            [
                'attribute' => 'description_en',
                'value' => $model->description_en,
                'format' => 'html',
                'contentOptions' => ['class' => 'description', 'style' => 'width: 70%'],
            ],
            'description_ru:html',
            [
                'attribute' => 'img',
                'value' => "<img src='{$image->getUrl('80x')}'></img>",
                'format' => 'html',
            ],
            [
                'attribute' => 'accessories',
                'value' => !$model->accessories ? '<span class="text-danger"><i class="fa fa-times"></i></span>' : '<span class="text-success"><i class="fa fa-check"></i></span>',
                'format' => 'html',
            ],
            [
                'attribute' => 'vase',
                'value' => function ($model) {
                    if ($model->vase) {
                        $images = $model->getImages();
                        foreach ($images as $image) {
                            if ($image->name == 'vase') {
                                return "<img src='{$image->getUrl('80x')}'></img><span>$model->vase sum</span>";
                            }
                        }
                    } else {
                        return '<span class="text-danger"><i class="fa fa-times"></i></span>';
                    }
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'prices',
                'value' => function ($model) {
                    $i = 1;
                    $strToReturn;
                    foreach ($model->prices as $price) {
                        $width_height = $price->width && $price->height ? "<br> - H: $price->height sm <br> - W: $price->width sm<br>" : '';
                        $strToReturn .= "$i $price->size - <i>$price->price</i> sum $width_height <br>";
                        $i++;
                    }
                    return $strToReturn;
                },
                'label' => 'Sizes',
                'format' => 'html',
            ],
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
    
    foreach($gallery as $image){
        if ($image->name != 'vase') {
            echo "<img src='{$image->getUrl('80x')}'></img>";
        }
    }

    ?>

</div>
