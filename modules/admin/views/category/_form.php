<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use app\components\MenuWidget;

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

            <div class="form-group field-category-parent_id has-success">
                <label class="control-label" for="category-parent_id">Parent</label>
                <select id="category-parent_id" class="form-control" name="Category[parent_id]" aria-invalid="false">
                    <option value="0">An independent category</option>
                    <?= MenuWidget::widget(['tpl' => 'select', 'model' => $model]) ?>
                </select>
            </div>

            <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

        </div>
    </div>

    <div class="panel panel-orange">
        <div class="panel-heading">2. Uploading Main Image</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="row preview-image" style="margin: 5px;">
                        <img src="<?= $mainImage->getUrl() ?>" style="width: 100%">
                    </div>
                </div>
                <div class="col-md-9">
                    <?= $form->field($model, 'image', ['labelOptions' => ['class' => 'btn btn-default', 'style' => 'display: block']])->fileInput(['class' => 'uploadImage', 'style' => 'width: 0.1px; height: 0.1px'])->label('<i class="fa fa-upload"></i> Upload image', ['']) ?>
                    <p>
                    <div class="col-md-6" style="padding: 0">
                        <p>Available extentions - jpg, jpeg, png</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-green">
        <div class="panel-heading">3. Work with text</div>
        <div class="panel-body">

            <?php
                if (isset($model->keywords)) {
                    $keywords_arr = explode(' ', $model->keywords);
                    if (in_array('unique', $keywords_arr)) {
                        $keys_count = count($keywords_arr);
                        for ($i = 0; $i < $keys_count; $i++) {
                            if ($keywords_arr[$i] == 'unique' || $keywords_arr[$i] == 'events-decoration' || $keywords_arr[$i] == 'business-roses') {
                                unset($keywords_arr[$i]);
                            }
                        }
                        $model->keywords = implode(" ", $keywords_arr);
                    }
                }
            ?>
            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

            <?php
            echo $form->field($model, 'description_en')->widget(CKEditor::className(), [
                'editorOptions' => ElFinder::ckeditorOptions('elfinder', []),
            ]);
            ?>

            <?php
            echo $form->field($model, 'description_ru')->widget(CKEditor::className(), [
                'editorOptions' => ElFinder::ckeditorOptions('elfinder', []),
            ]);
            ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>