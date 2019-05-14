<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Color */

$this->title = $model->color_en;
$this->params['breadcrumbs'][] = ['label' => 'Colors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= AdminTitle::widget(['title' => $this->title, 'breadcrumbs' => $this->params['breadcrumbs']]) ?>
<div class="color-view page-content">

    <?php
    // get image
    $image = $model->getImage();
    ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'color_en',
            'color_ru',
            [
                'attribute' => 'image',
                'value' => '<img src=' . $image->getUrl("150x150") . ' alt="">',
                'format' => 'html',
            ],
        ],
    ]) ?>

</div>