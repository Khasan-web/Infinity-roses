<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<section id="login">
        <h1><?= Yii::t('app', 'Login')?> <span class="gold">Infinity-roses</span></h1>
		<div class="col-lg-2 col-md-6 col-10 mx-auto mt-4">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
            ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => Yii::t('app', 'Username')])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('app', 'Password')])->label(false) ?>

                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"custom-control custom-checkbox\">{input}<label class=\"custom-control-label\" for=\"loginform-rememberme\">" . Yii::t('app', 'Remember me') . "</label></div>",
                    'class' => 'custom-control-input']) ?>

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-outline-dark', 'name' => 'login-button']) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>

		</div>
	</section>