<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MenuWidget;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form" data-id="<?= $model->id?>">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

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

    <div class="panel panel-red">
        <div class="panel-heading">2. Prices and Sizes</div>
        <div class="panel-body sizes">

            <ol class="added-sizes" data-page-id="<?= $model->id?>">
                <?php if ($pricesModel):?>
                    <?php foreach ($pricesModel as $size):?>
                        <li data-id="<?= $size->id?>"><i class="fa fa-times remove-size" style="margin: 0 5px;"></i><?= $size->size . ' | ' . $size->price . ' sum'?></li>
                    <?php endforeach;?>
                <?php endif;?>
            </ol>
            <hr>
            <div class="form-inline">
                <div class="form-group">
                    <input type="text" id="size" placeholder="size" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" id="price" placeholder="price" class="form-control">
                </div>
                <button class="btn btn-info" id="add-new-size" onclick="return false">Add new size</button>
            </div>

        </div>
    </div>

    <?php
        $mainImage = $model->getImage();
        $gallery = $model->getImages();
    ?>

    <div class="panel panel-orange">
        <div class="panel-heading">3. Uploading Main Image</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="row preview-image">
                        <?php if ($mainImage->name):?>
                        <img src="<?= $mainImage->getUrl()?>" style="width: 100%">
                        <?php endif;?>
                    </div>
                </div>
                <div class="col-md-9">
                    <?= $form->field($model, 'image', ['labelOptions' => ['class' => 'btn btn-default', 'style' => 'display: block']])->fileInput(['class' => 'uploadImage', 'style' => 'width: 0.1px; height: 0.1px'])->label('<i class="fa fa-upload"></i> Upload image', ['']) ?>

                    <p><strong>Name: </strong> <span class="name">
                            <?= $mainImage->name ? $mainImage->name . '.' . $mainImage->extension : '---'?></span></p>

                    <?php if ($mainImage->name):?>
                    <p><strong>Size: </strong> <span class="size"> ---</span></p>
                    <?php endif;?>
                    <p><strong>Color: </strong> <span class="color">
                            <?= $mainImage->name ? $mainImage->name : '---'?></span></p>
                    <hr>
                    <div class="col-md-6" style="padding: 0">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusantium quaerat rerum vero
                            modi, laudantium consectetur?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-violet">
        <div class="panel-heading">4. Uploading a gallery</div>
        <div class="panel-body" style="margin: 0 15px">

            <!-- Gallery from db -->
            <div class="row text-center gallery">
                <?php if ($gallery[1]):?>
                <h3 style="margin-top: 5px">Gallery</h3>
                <?php foreach ($gallery as $file):?>

                <div class="col-md-1" style="margin: 15px 0">
                    <div class="removeImage" data-image="<?= $file->urlAlias?>">
                        <i class="fa fa-times" onclick="confirm('Are you sure you want to delete this image?')"></i>
                    </div>
                    <img src="<?= $file->getUrl()?>" style="width: 100%">
                    <p style="margin-top: 5px"><?= $file->name . '.' . $file->extension?></p>
                </div>

                <?php endforeach;?>
                <?php endif;?>
            </div>

            <!-- New images in the existing gallery -->
            <div class="row">
                <?= $form->field($model, 'gallery[]', ['labelOptions' => ['class' => 'btn btn-default', 'style' => 'display: block']])->fileInput(['class' => 'uploadGallery', 'style' => 'width: 0.1px; height: 0.1px', 'multiple' => true, 'accept' => 'image/*'])->label('<i class="fa fa-upload"></i> Upload a gallery', ['']) ?>
                <div class="row preview-images text-center" style="padding: 15px">

                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-green">
        <div class="panel-heading">5. Work with text</div>
        <div class="panel-body">

            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
            <p>In the keywords you can add any information you want, there may also be keys to formulate some parts of any product. <br> <i>Keys can be added in any part of a keywords</i></p>
            
            <ol>
                <li>Accessories - this key make a product available to has parfume and chocolate</li>
                <li>Bouquet - this key shows that a product is bouquet and it can has a vase</li>
            </ol>

            <hr>

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
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success save-product', 'data-product-id' => $model->id]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>