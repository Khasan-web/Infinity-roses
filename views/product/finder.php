<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<section id="finder-page" class="dark-elements">
    <h1><?= Yii::t('app', 'Gift Finder')?></h1>
        <div class="container mt-5">
        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'options' => [
                    'tag' => false,
                ]
            ]
        ]);?>
            <div class="row mx-auto my-4">
                <div class="col-md-2 col-12">
                <h3><?= Yii::t('app', 'For:')?></h3>
                </div>
                <div class="col-md-2 col-12 mx-auto">
                <div class="custom-control custom-switch">
                    <!-- <input type="checkbox" name="event" class="custom-control-input"> -->
                        <?= $form->field($model, 'event_1')->checkbox()->input('checkbox', ['class' => 'custom-control-input']);?>
                    <label class="custom-control-label" for="customSwitches">Valentine's</label>
                </div>
                </div>
                <div class="col-md-2 col-12 mx-auto">
                    <div class="custom-control custom-switch">
                        <?= $form->field($model, 'event_2')->checkbox()->input('checkbox', ['class' => 'custom-control-input']);?>
                        <label class="custom-control-label" for="customSwitches">Women's Day</label>
                    </div>
                </div>
                <div class="col-md-2 col-12 mx-auto">
                    <div class="custom-control custom-switch">
                        <?= $form->field($model, 'event_3')->checkbox()->input('checkbox', ['class' => 'custom-control-input']);?>
                        <label class="custom-control-label" for="customSwitches">Nowruz</label>
                    </div>
                </div>
                <div class="col-md-2 col-12 mx-auto">
                    <div class="custom-control custom-switch">
                        <?= $form->field($model, 'large')->checkbox()->input('checkbox', ['class' => 'custom-control-input']);?>
                        <label class="custom-control-label" for="customSwitches">Large</label>
                    </div>
                </div>
            </div>
            <div class="row mx-auto my-4">
                <div class="col-md-2 col-12">
                <h3><?= Yii::t('app', 'Rose type:')?></h3>
                </div>
                <div class="col-md-2 col-12 mx-auto">
                <div class="custom-control custom-switch">
                        <?= $form->field($model, 'fresh')->checkbox()->input('checkbox', ['class' => 'custom-control-input']);?>
                    <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Fresh ( Classic )')?></label>
                </div>
                </div>
                <div class="col-md-3 col-12 mx-auto">
                <div class="custom-control custom-switch">
                        <?= $form->field($model, 'infinity')->checkbox()->input('checkbox', ['class' => 'custom-control-input']);?>
                    <label class="custom-control-label" for="customSwitches"><?= Yii::t('app', 'Long lasting roses ( Infinity )')?></label>
                </div>
                </div>
                <!-- offset -->
                <div class="col-md-1 col-0 mx-auto"></div>
                <div class="col-md-2 col-0 mx-auto"></div>
                <!-- end offset -->
            </div>
            <div class="row mx-auto my-4">
                <div class="col-md-2 col-12">
                <h3><?= Yii::t('app', 'Price:')?></h3>
                </div>
                <div class="col-md-9 col-12 mx-auto p-sm-0">
                    <?= $form->field($model, 'price')
                    ->textInput(['value' => "[{$model->price_min},{$model->price_max}]"])
                    ->label(false)
                    ->input('text', [
                        'class' => 'custom-control-input',
                        'id' => 'gift-finder-page',
                        'data-slider-tooltip' => "show",
                        'data-slider-min' => $minmax['min'],
                        'data-slider-max' => $minmax['max'],
                        'data-slider-step' => "10",
                        'data-slider-value' => $model->price_min && $model->price_min > $minmax['min'] ? "[" . $model->price_min . "," . $model->price_max . "]" : "[" . $minmax['min'] . "," . $minmax['max'] . "]",
                    ]);
                    ?>
                    <div class="row">
                        <div class="col-6 text-left pl-1">
                        <span class="price min">$<?= $minmax['min']?></span>
                        </div>
                        <div class="col-6 text-right pr-1">
                        <span class="price max">$<?= $minmax['max']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-4 text-center">
                <button class="btn btn-outline-dark" type="submit"><?= Yii::t('app', 'Find Roses!')?></button>
            </div>
            <?php ActiveForm::end()?>

            <hr>

            <div class="text-center">
                <?php if (!$products): ?>
                <h2 class="not-found"><?= Yii::t('app', 'Nothing is found...');?></h2>
                <?php else:?>
                <div class="row mt-5">
                    <?php foreach ($products as $product): ?>
                    <?php $image = $product->getImage()?>
                        <div class="col-lg-3 col-md-6 product wow fadeIn" data-wow-delay="0.6s">
                            <a href="<?= Url::to(['product/view', 'id' => $product->id])?>">
                                <img src="<?= $image->getUrl()?>" alt="" class="w-100" />
                                <h2 class="name"><?= $product->name?></h2>
                            </a>
                            <p class="price"><?= $product->category->$name?></p>
                        </div>
                    <?php endforeach;?>
                </div>
                <?php endif;?>
            </div>

        </div>
</section>