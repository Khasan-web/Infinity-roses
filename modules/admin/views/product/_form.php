<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MenuWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">


    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'category_id')->textInput() ?>

    <div class="panel panel-blue">
        <div class="panel-heading">1. Basic info</div>
        <div class="panel-body">

            <div class="form-group field-category-parent_id has-success">
                <label class="control-label" for="product-category_id">Category</label>
                <select id="product-category_id" class="form-control" name="Product[category_id]" aria-invalid="false">
                <option value="hello" disabled selected>Select Category</option>
                    <?= MenuWidget::widget(['tpl' => 'select-product', 'model' => $model])?>
                </select>
            </div>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'price')->textInput() ?>

            <?php //echo $form->field($model, 'hit')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

            <?= $form->field($model, 'hit')->checkbox()?>

        </div>
    </div>

    <div class="panel panel-orange">
        <div class="panel-heading">2. Uploading images</div>
        <div class="panel-body">

            <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

        </div>
    </div>

    <div class="panel panel-green">
        <div class="panel-heading">3. Work with text</div>
        <div class="panel-body">

        <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'description_ru')->textarea(['rows' => 6]) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
