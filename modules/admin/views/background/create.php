<?php

use yii\helpers\Html;
use app\components\AdminTitle;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Background */

$this->title = 'Create Background';
$this->params['breadcrumbs'][] = ['label' => 'Backgrounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= AdminTitle::widget(['title' => $this->title])?>
<div class="background-create page-content">

    <?= $this->render('_form', [
        'model' => $model,
        'positions' => $positions,
    ]) ?>

</div>
