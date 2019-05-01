<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KituoBalance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kituo-balance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kituo_id')->textInput() ?>

    <?= $form->field($model, 'credit_turn_over')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'debit_turn_over')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value_dt')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
