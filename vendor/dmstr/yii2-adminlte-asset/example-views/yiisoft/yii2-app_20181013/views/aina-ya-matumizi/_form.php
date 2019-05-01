<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AinaYaMatumizi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aina-ya-matumizi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'matumizi')->textInput(['maxlength' => true,'placeholder' => 'Ingiza aina ya matumizi']) ?>

    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
