<?php

use yii\helpers\Html;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Color */

$this->title = 'Update Color: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Colors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= AdminTitle::widget(['title' => $this->title, 'breadcrumbs' => $this->params['breadcrumbs']]) ?>
<div class="color-update page-content">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
