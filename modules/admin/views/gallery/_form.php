<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MenuWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="panel panel-blue">
        <div class="panel-heading">1. Upload an image</div>
        <div class="panel-body">
            <!-- New images in the existing gallery -->
            <div class="gallery__upload px-3">
                <?= $form->field($model, 'gallery[]', ['labelOptions' => ['class' => 'btn btn-default', 'style' => 'display: block']])->fileInput(['class' => 'uploadGallery', 'style' => 'width: 0.1px; height: 0.1px', 'multiple' => true, 'accept' => 'image/*'])->label('<i class="fa fa-upload"></i> Upload a gallery', ['']) ?>
                <div class="row preview-images gallery__preview text-center">
                    <!-- here will be selected images -->
                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-green">
        <div class="panel-heading">2. Select a category</div>
        <div class="panel-body">

            <?= $form->field($model, 'category_id')->dropDownList($dropdownArr)?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>