<?php

use yii\helpers\Html;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Events */

$this->title = Yii::t('app', 'Create Events');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= AdminTitle::widget(['title' => Html::encode($this->title), 'breadcrumbs' => $this->params['breadcrumbs']])?>
<div class="events-create page-content">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
