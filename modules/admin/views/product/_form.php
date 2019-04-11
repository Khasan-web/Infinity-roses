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

            <?php //echo $form->field($model, 'hit')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

            <?= $form->field($model, 'hit')->checkbox()?>

            <?= $form->field($model, 'accessories')->checkbox()?>

            <?= $form->field($model, 'vase')->textInput()->label('Price of a vase')?>
            <p>if you set the price, the product will be a bouquet and it will have a vase selection function</p>

        </div>
    </div>

    <div class="panel panel-red">
        <div class="panel-heading">2. Prices and Sizes</div>
        <div class="panel-body sizes">

            <ol class="added-sizes" data-page-id="<?= $model->id?>">
                <?php if ($pricesModel):?>
                    <?php foreach ($pricesModel as $size):?>
                        <li data-id="<?= $size->id?>"><i class="fa fa-times remove-size" style="margin: 0 5px;"></i><?= $size->size . ' ' . "($size->height cm H x $size->width cm W)" . ' | ' . $size->price . ' sum'?></li>
                    <?php endforeach;?>
                <?php endif;?>
            </ol>
            <hr>
            <div class="form-inline">
                <div class="form-group">
                    <input type="text" id="size" placeholder="size" class="form-control">
                </div>
                <div class="form-group">
                    <input type="number" id="height" placeholder="height cm" class="form-control">
                </div>
                <div class="form-group">
                    <input type="number" id="width" placeholder="width cm" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" id="price" placeholder="price" class="form-control">
                </div>
                <button class="btn btn-info" id="add-new-size" onclick="return false">Add new size</button>
            </div>
            <p style="margin-top: 15px;">If this product is bouquet, then width and height are not important to set</p>
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
                <div class="col-md-3 preview-image">
                    <?php if ($mainImage->name):?>
                        <img src="<?= $mainImage->getUrl()?>" style="width: 100%">
                    <?php endif;?>
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
                        <p>Main image should have "small" size or least amount of stems, if the product has several sizes</p>
                        <p>There are some conditions to upload images:</p>
                        <ol>
                            <li>Prepare your images before uploading - they should looks like other images</li>
                            <li>Rename your images before uploading - there is specific structure of a file name:</li>
                            <ul>
                                <li><strong>color_position_size.extensition</strong></li>
                                <br>
                                <i><li>Symbol " _ " you can get by pressing (shift  + -[minus]) ( near 0 and under F10 and F11 )</li></i>
                                <br>
                                <li>color - this part of the name will be a color of this image</li>
                                <li>position - certain perspective of product view</li>
                                <li>size - size of product on the image (cm)</li>
                                <li>extensition - ( jpg, jpeg, png )</li>
                            </ul>
                        </ol>
                        <p>Same for a gallery</p>
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
                <?php if ($gallery[0]):?>
                <h3 style="margin-top: 5px">Gallery</h3>
                <?php $i = 0; foreach ($gallery as $image):?>
                <?php if ($image->urlAlias != 'placeHolder'):?>
                <div class="col-md-1 col-sm-2" style="margin: 15px 0">
                    <div class="removeImage" data-image="<?= $image->urlAlias?>">
                        <i class="fa fa-times"></i>
                    </div>
                        <img src="<?= $image->getUrl('80x')?>" style="width: 100%">
                    <?php
                        $name_explode = explode('_', $image->name);
                            $name = $name_explode[0];
                            $position = $name_explode[1];
                        if (count($name_explode) > 2) {
                            $size = explode('.', $name_explode[2])[0];
                        }
                    ?>
                    <p style="margin-top: 5px; margin-bottom: 0;"><?= $name?></p>
                    <?php  if ($position) {
                        echo "<p style='margin: 0'>Pos. №$position</p>";
                    }?>
                    <?php  if (count($name_explode) > 2):?>
                        <p style="margin: 0"><?= $size?></p>
                    <?php endif;?>
                </div>
                <?php
                $i++;
                if ($i == 12) {
                    echo '<div class="clearfix"></div>';
                    $i = 0;
                }
                ?>
                <?php endif;?>
                <?php endforeach;?>
                <?php endif;?>
            </div>

            <!-- New images in the existing gallery -->
            <div class="row">
                <?= $form->field($model, 'gallery[]', ['labelOptions' => ['class' => 'btn btn-default', 'style' => 'display: block']])->fileInput(['class' => 'uploadGallery', 'style' => 'width: 0.1px; height: 0.1px', 'multiple' => true, 'accept' => 'image/*'])->label('<i class="fa fa-upload"></i> Upload a gallery', ['']) ?>
                <div class="row preview-images text-center" style="padding: 15px">
                    <div class="col-md-1 col-sm-2">
                        <img src="/web/img/img-placeholder.png" style="width: 100%;" alt="">
                        <p style="margin-top: 5px; margin-bottom: 0">Name</p>
                        <p style="margin: 0;">Pos. №</p>
                        <p style="margin: 0;">Size</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-green">
        <div class="panel-heading">5. Work with text</div>
        <div class="panel-body">

            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
            <p>In the keywords you can add any information you want, there may also be keys to formulate belonging of product to some gift finder categories. <br> <i>Keys can be added in any part and there are</i></p>
            
            <ol>
                <li>Event</li>
                <li>Her</li>
                <li>Him</li>
                <li>Home</li>
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