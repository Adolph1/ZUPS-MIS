<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ViambatanishoMzee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="viambatanisho-mzee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mzee_id')->textInput() ?>

    <?= $form->field($model, 'aina_id')->textInput() ?>

    <?= $form->field($model, 'kiambatanisho')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
