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

<div class="product-form" data-id="<?= $model->id ?>">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="panel panel-blue">
        <div class="panel-heading">1. Basic info</div>
        <div class="panel-body">

            <div class="form-group field-category-parent_id has-success">
                <label class="control-label" for="product-category_id">Category</label>
                <select id="product-category_id" class="form-control" name="Product[category_id]" aria-invalid="false">
                    <option value="hello" disabled selected>Select Category</option>
                    <?= MenuWidget::widget(['tpl' => 'select-product', 'model' => $model]) ?>
                </select>
            </div>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'hit')->checkbox() ?>

            <?= $form->field($model, 'accessories')->checkbox() ?>

            <?= $form->field($model, 'vase')->textInput()->label('Price of a vase') ?>
            <p>if you set the price, the product will be a bouquet and it will have a vase selection function</p>

        </div>
    </div>


    <?php if (Yii::$app->controller->action->id == 'update') : ?>
        <div class="panel panel-red">
            <div class="panel-heading">2. Prices and Sizes</div>
            <div class="panel-body sizes">
                <ol class="added-sizes" data-page-id="<?= $model->id ?>">
                    <?php if ($pricesModel) : ?>
                        <?php foreach ($pricesModel as $size) : ?>
                            <li data-id="<?= $size->id ?>"><i class="fa fa-times remove-size" style="margin: 0 5px;"></i><?= $size->size . ' ' . "($size->height cm H x $size->width cm W)" . ' | ' . $size->price . ' sum' ?>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ol>
                <hr>
                <div class="form-inline">
                    <div class="form-group">
                        <input type="text" id="size" placeholder="size" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="size_ru" class="form-control" style="display:none;" placeholder="size ru">
                    </div>
                    <div class="form-group">
                        <!-- Choosing a type [ roses, stems or smth else ] -->
                        <select class="form-control" id="size_type">
                            <option value="Roses" selected>Roses</option>
                            <option value="Stems">Stems</option>
                            <option value="">Personal type</option>
                        </select>
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
                <p style="margin-top: 15px;">If this product is bouquet, then you can skip width and height</p>
            </div>
        </div>

        <?php
        $mainImage = $model->getImage();
        $gallery = $model->getImages();
        ?>
        <?php if (!empty($pricesModel)) : ?>
            <div class="panel panel-orange">
                <div class="panel-heading">3. Uploading Main Image</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 preview-image main-image" data-size="<?= $model->prices[0]->size?>" data-position="1">
                            <?php if (isset($mainImage->name)) : ?>
                                <img src="<?= $mainImage->getUrl() ?>" style="width: 100%">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($model, 'image', ['labelOptions' => ['class' => 'btn btn-default', 'style' => 'display: block']])->fileInput(['class' => 'uploadImage', 'style' => 'width: 0.1px; height: 0.1px'])->label('<i class="fa fa-upload"></i> Upload image', ['']) ?>
                            <?= $form->field($model, 'size_main')->textInput(['class' => 'sr-only'])->label(false);?>
                            <?php
                            // getting the color of main image
                            $color = isset($mainImage->name) ? explode('_', $mainImage->name)[0] : false;
                            ?>
                            <button class="btn <?= $color ? 'btn-default' : 'btn-warning'?> btn-sm main-img-color"><?= $color ? $color : 'COLOR'?></button>
                            <hr>
                            <p>Image you are uploading will be 1st position and size will be <?= $model->prices[0]->size?></p>
                            <p>In any case upload image which is appropriate</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-violet">
                <div class="panel-heading">4. Uploading a gallery</div>
                <div class="panel-body" style="margin: 0 15px">
                    <!-- Buttons to switch sizes -->
                    <div class="btn-sizes">
                        <?php
                        $i = 0;
                        foreach ($model->prices as $size) : ?>
                            <button class="btn <?= $i == 0 ? 'btn-warning' : 'btn-default' ?> size-toggle" data-size="<?= $size->size ?>"><?= $size->size ?></button>
                            <?php
                            $i++;
                        endforeach; ?>
                        <button class="btn btn-default show-all">All</button>
                        <button class="btn btn-danger btn-remove_all" data-position="1">Remove all images</button>
                        <button class="btn btn-default btn-not_available" data-position="1">Not available</button>
                    </div>
                    <!-- Buttons to switch position -->
                    <div class="btn-positions">
                        <button class="btn btn-warning position-toggle" data-position="1">1st</button>
                        <button class="btn btn-default position-toggle" data-position="2">2nd</button>
                        <button class="btn btn-default position-toggle" data-position="closed">Closed</button>
                        <!-- show only if we have price of vase -->
                        <button class="btn btn-default position-toggle vase-toggle" data-position="vase">Vase</button>
                    </div>
                    <!-- Gallery from db -->
                    <div class="row text-center gallery">
                        <?php if ($gallery[0]) : ?>
                            <h3 style="margin-top: 5px">Gallery</h3>
                            <?php
                            $i = 0;
                            foreach ($gallery as $image) : ?>
                                <?php 
                                // explode a name of each image
                                $name_explode = explode('_', $image->name);
                                //  && !in_array('vase', $name_explode)
                                if ($image->urlAlias != 'placeHolder') : ?>

                                    <?php
                                    // getting all info
                                    $color_en = $name_explode[0];
                                    $color_ru = $name_explode[1];
                                    if (count($name_explode) > 2) {
                                        $position = $name_explode[2];
                                    }
                                    if (count($name_explode) > 3) {
                                        $size = explode('.', $name_explode[3])[0];
                                    } else {
                                        $size = '';
                                    }
                                    $status = end($name_explode);
                                    ?>

                                    <div class="col-md-1 col-sm-2 size" style="opacity: <?= !$status ? '0.6' : '1'?>" data-size="<?= $size ?>" style="margin: 15px 0">
                                        <?php if ($color_en != 'vase'):?>
                                            <div class="checkbox-none">
                                                <input type="checkbox" class="not-available-check form-control" <?= !$status ? 'checked' : ''?> data-id="<?= $image->id?>">
                                            </div>
                                        <?php endif;?>
                                        <div class="removeImage" data-image="<?= $image->urlAlias ?>">
                                            <i class="fa fa-times"></i>
                                        </div>
                                        <img src="<?= $image->getUrl('80x') ?>" style="width: 100%">
                                        <p style="margin-top: 5px; margin-bottom: 0;"><?= $color_en ? $color_en : '' ?></p>
                                        <?php if ($position && $color_en != 'vase') {
                                            $show_positon = $position == 'vase' ? 'vase' : 'Pos №' . $position;
                                            echo "<p style='margin: 0'>$show_positon</p>";
                                        } ?>
                                        <?php if (count($name_explode) > 2) : ?>
                                            <p style="margin: 0"><?= $size ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <?php
                                    $i++;
                                    if ($i == 12) {
                                        echo '<div class="clearfix"></div>';
                                        $i = 0;
                                    }
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <?php
                    // non available products id
                    echo $form->field($model, 'not_available')->textInput(['class' => 'sr-only'])->label(false);
                    // Model will get string from here to create name of the image and js will add size --> colorName_position_size
                    echo $form->field($model, 'size_list')->textInput(['class' => 'sr-only'])->label(false);
                    ?>

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
                    <hr>
                    <ol>
                        <li>Don't upload main image again in the gallery</li>
                        <li>Upload only one position of one size at a time</li>
                    </ol>

                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="panel panel-green">
        <?php
        // just changing number of the table
        if (Yii::$app->controller->action->id == 'update') {
            if (!empty($pricesModel)) {
                $text_i = 5;
            } else {
                $text_i = 3;
            }
        } else {
            $text_i = 2;
        }
        ?>
        <div class="panel-heading"><?= $text_i ?>. Work with text</div>
        <div class="panel-body">

            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
            <p>In the keywords you can add any information you want, there may also be keys to formulate belonging of
                product to some gift finder categories. <br> <i>Keys can be added in any part and there are</i></p>

            <ol>
                <li>Event</li>
                <li>Her</li>
                <li>Him</li>
                <li>Home</li>
            </ol>

            <hr>

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
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success save-product btn-block', 'data-product-id' => $model->id]) ?>
    </div>

    <?php ActiveForm::end(); ?>


    <!-- COLOR SELECTION MODAL -->
    <div id="img-color" class="modal fade w-25" role="dialog">
        <div class="modal-dialog" style="width: 400px">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Please select a color</h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                    <?php // show colors in modal
                        $i = 0; foreach ($colors as $color) : ?>
                        <?php $color_img = $color->getImage()?>
                        <div class="col-md-6">
                            <img class="color-img" src="<?= $color_img->getUrl('50x') ?>" alt="">
                            <input type="radio" name="color" id="<?= $color->id ?>" data-value-ru="<?= $color->color_ru ?>" value="<?= $color->color_en ?>">
                            <label for="<?= $color->id ?>"><?= $color->color_en ?></label>
                        </div>

                    <?php $i++; endforeach; //end showing?>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success accept-color btn-block">Accept a color</button>
                </div>
            </div>

        </div>
    </div>
    <!-- COLOR SELECTION MODAL END -->

</div>