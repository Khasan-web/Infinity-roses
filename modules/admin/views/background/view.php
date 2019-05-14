<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\AdminTitle;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Background */

$this->title = $model->position;
$this->params['breadcrumbs'][] = ['label' => 'Backgrounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= AdminTitle::widget(['title' => $this->title])?>
<div class="background-view page-content">

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
            'filePath',
            'position',
            'title_en',
            'title_ru',
            'description_en',
            'description_ru',
        ],
    ]) ?>

</div>
