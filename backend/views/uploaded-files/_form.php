<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UploadedFiles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uploaded-files-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uploaded_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uploaded_date')->textInput() ?>

    <?= $form->field($model, 'time_uploaded')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
