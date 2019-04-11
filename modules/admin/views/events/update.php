<?php

use yii\helpers\Html;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Events */
$name = 'name_' . Yii::$app->language;
$this->title = Yii::t('app', 'Update Events: {name}', [
    'name' => $model->$name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->$name, 'url' => ["view?id=$model->id"]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?= AdminTitle::widget(['title' => Html::encode($this->title), 'breadcrumbs' => $this->params['breadcrumbs']])?>
<div class="events-update page-content">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
