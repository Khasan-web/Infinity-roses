<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\AdminTitle;

$this->title = Yii::t('app', 'Profile');
$this->params['breadcrumbs'][] = $this->title;

?>

<?= AdminTitle::widget(['title' => $this->title])?>
<?php $image = $user->getImage()?>

<div class="admin-profile page-content">

    <div class="row">
        <div class="col-md-3 info-cart">
            <img src="<?= $image->getUrl()?>" alt="">
            <?php $form = ActiveForm::begin(['options' => ['style' => 'margin-top: 20px']])?>
                <?= $form->field($user, 'username')->input('username', ['placeholder' => 'New Username'])?>
                <?= $form->field($user, 'newPassword')?>
                <div class="row">
                    <div class="col-md-2" style="padding: 0 10px 10px 10px">
                        <div class="preview-image">
                        
                        </div>
                    </div>
                    <div class="col-md-10">
                        <?= $form->field($user, 'image', ['labelOptions' => ['class' => 'btn btn-default', 'style' => 'display: block']])->fileInput(['class' => 'uploadImage', 'style' => 'width: 0.1px; height: 0.1px'])->label('<i class="fa fa-upload"></i> Upload image', ['']) ?>
                    </div>
                </div>
                <div class="form-group text-center">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>
            <?php ActiveForm::end()?>
        </div>
    </div>

</div>