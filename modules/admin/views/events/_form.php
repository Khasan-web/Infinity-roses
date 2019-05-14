<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Events */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-form">

    <?php $mainImage = $model->getImage()?>

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-blue">
        <div class="panel-heading">1. Event name and keywords</div>
        <div class="panel-body">

            <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
            <div class="alert alert-success">
                You can add any events! For example, a holiday, a new product or an action in infinity roses.
            </div>
            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

        </div>
    </div>

    <div class="panel panel-orange">
        <div class="panel-heading">2. Set dates</div>
        <div class="panel-body">

            <?= $form->field($model,'date_from')->widget(DatePicker::className(), ['options' => ['class' => 'form-control date'], 'dateFormat' => 'yyyy-MM-dd']) ?>

            <?= $form->field($model,'date_to')->widget(DatePicker::className(), ['options' => ['class' => 'form-control date'], 'dateFormat' => 'yyyy-MM-dd']) ?>

        </div>
    </div>

    <div class="panel panel-green">
        <div class="panel-heading">3. Work with text</div>
        <div class="panel-body">

            <?php
                echo $form->field($model, 'description_en')->widget(CKEditor::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
                ]);
            ?>

            <?php
                echo $form->field($model, 'description_ru')->widget(CKEditor::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
                ]);
            ?>

        </div>
    </div>

    <div class="panel panel-orange">
        <div class="panel-heading">4. Uploading Main Image</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="row preview-image" style="margin: 5px;">
                        <img src="<?= $mainImage->getUrl()?>" style="width: 100%">
                    </div>
                </div>
                <div class="col-md-9">
                    <?= $form->field($model, 'image', ['labelOptions' => ['class' => 'btn btn-default', 'style' => 'display: block']])->fileInput(['class' => 'uploadImage', 'style' => 'width: 0.1px; height: 0.1px'])->label('<i class="fa fa-upload"></i> Upload image', ['']) ?>
                    <hr>
                    <div class="col-md-6" style="padding: 0">
                        <p>Available extentions - jpg, jpeg, png</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>