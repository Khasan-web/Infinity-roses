<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<section id="finder-page" class="dark-elements">
    <h1>Gift Finder</h1>
        <div class="container">
        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'options' => [
                    'tag' => false,
                ]
            ]
        ]);?>
            <div class="row mx-auto my-4">
                <div class="col-md-2 col-12">
                <h3>For:</h3>
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
                <h3>Rose type:</h3>
                </div>
                <div class="col-md-2 col-12 mx-auto">
                <div class="custom-control custom-switch">
                        <?= $form->field($model, 'fresh')->checkbox()->input('checkbox', ['class' => 'custom-control-input']);?>
                    <label class="custom-control-label" for="customSwitches">Fresh ( Classic )</label>
                </div>
                </div>
                <div class="col-md-3 col-12 mx-auto">
                <div class="custom-control custom-switch">
                        <?= $form->field($model, 'infinity')->checkbox()->input('checkbox', ['class' => 'custom-control-input']);?>
                    <label class="custom-control-label" for="customSwitches">Long lasting roses ( Infinity )</label>
                </div>
                </div>
                <!-- offset -->
                <div class="col-md-1 col-0 mx-auto"></div>
                <div class="col-md-2 col-0 mx-auto"></div>
                <!-- end offset -->
            </div>
            <div class="row mx-auto my-4">
                <div class="col-md-2 col-12">
                <h3>Price:</h3>
                </div>
                <div class="col-md-9 col-12 mx-auto p-sm-0">
                    <input type="text" name="price"
                     data-slider-tooltip="show" 
                     data-slider-min="100" 
                     data-slider-max="10000" 
                     data-slider-step="10" 
                     data-slider-value="[0,10000]" 
                     class="custom-control-input" 
                     id="gift-finder-page">
                    <?= $form->field($model, 'price')->textInput()->input('text', ['class' => 'custom-control-input']);?>
                    <div class="row">
                        <div class="col-6 text-left pl-1">
                        <span class="price min">$100</span>
                        </div>
                        <div class="col-6 text-right pr-1">
                        <span class="price max">$10000</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-4 text-center">
                <button class="btn btn-outline-dark" type="submit">Find Roses!</button>
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
                            <p class="price">from $<?= $product->price?></p>
                        </div>
                    <?php endforeach;?>
                </div>
                <?php endif;?>
            </div>

        </div>
</section>