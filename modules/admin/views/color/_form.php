<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Color */
/* @var $form yii\widgets\ActiveForm */

$mainImage = $model->getImage();
?>

<div class="color-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-blue">
        <div class="panel-heading">1. Color names</div>
        <div class="panel-body">

            <?= $form->field($model, 'color_en')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'color_ru')->textInput(['maxlength' => true]) ?>

        </div>
    </div>

    <div class="panel panel-green">
        <div class="panel-heading">2. Upload an example image</div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-3">
                    <div class="row preview-image" style="margin: 5px;">
                        <img src="<?= Yii::$app->controller->action->id == 'update' ? $mainImage->getUrl() : '/web/upload/store/no-image.png'?>" style="width: 100%">
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