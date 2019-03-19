<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $mainImage = $model->getImage();
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-blue">
        <div class="panel-heading">1. Basic info</div>
        <div class="panel-body">

            <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'secondary')->checkbox() ?>

        </div>
    </div>

    <div class="panel panel-orange">
        <div class="panel-heading">2. Uploading Main Image</div>
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
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusantium quaerat rerum vero modi, laudantium consectetur?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-green">
        <div class="panel-heading">3. Work with text</div>
        <div class="panel-body">

            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>