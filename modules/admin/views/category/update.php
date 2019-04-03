<?php

use yii\helpers\Html;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */

$this->title = Yii::t('app', 'Update Category: {name}', [
    'name' => $model->name_en,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_en, 'url' => ["view?id=$model->id"]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?= AdminTitle::widget(['title' => $this->title, 'breadcrumbs' => $this->params['breadcrumbs']])?>
<div class="category-update page-content">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
