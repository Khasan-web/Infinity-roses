<?php

use yii\helpers\Html;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Color */

$this->title = 'Create Color';
$this->params['breadcrumbs'][] = ['label' => 'Colors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= AdminTitle::widget(['title' => $this->title, 'breadcrumbs' => $this->params['breadcrumbs']]) ?>
<div class="color-create page-content">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
