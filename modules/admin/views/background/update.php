<?php

use yii\helpers\Html;
use app\components\AdminTitle;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Background */

$this->title = 'Update Background: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Backgrounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= AdminTitle::widget(['title' => $this->title])?>
<div class="background-update page-content">

    <?= $this->render('_form', [
        'model' => $model,
        'positions' => $positions,
    ]) ?>

</div>
