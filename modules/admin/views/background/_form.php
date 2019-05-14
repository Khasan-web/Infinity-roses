<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Background */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="background-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-blue">
        <div class="panel-heading">1. Path and Position</div>
        <div class="panel-body">

            <?php echo $form->field($model, 'filePath')->widget(InputFile::className(), [
                'language'      => 'ru',
                'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
                'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                'options'       => ['class' => 'form-control'],
                'buttonOptions' => ['class' => 'btn btn-warning'],
                'multiple'      => false       // возможность выбора нескольких файлов
            ]); ?>

            <?= $form->field($model, 'position')->dropDownList($positions) ?>

        </div>
    </div>

    <div class="panel panel-green">
        <div class="panel-heading">2. Work with text</div>
        <div class="panel-body">

            <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description_en')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description_ru')->textInput(['maxlength' => true]) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>