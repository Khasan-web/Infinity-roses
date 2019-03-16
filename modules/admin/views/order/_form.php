<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-orange">
        <div class="panel-heading">1. Set status</div>
        <div class="panel-body">

            <?= $form->field($model, 'status')->checkbox() ?>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis, mollitia nemo. In cumque reiciendis repudiandae.</p>

        </div>
    </div>

    <div class="panel panel-green">
        <div class="panel-heading">1. Products info</div>
        <div class="panel-body">

            <?= $form->field($model, 'qty')->textInput() ?>

            <?= $form->field($model, 'sum')->textInput() ?>

        </div>
    </div>

    <div class="panel panel-violet">
        <div class="panel-heading">2. Personal info</div>
        <div class="panel-body">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
