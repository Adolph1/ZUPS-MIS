<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GlDailyBalance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gl-daily-balance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trn_date')->textInput() ?>

    <?= $form->field($model, 'gl_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opening_balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dr_turn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cr_turn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'closing_balance')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
