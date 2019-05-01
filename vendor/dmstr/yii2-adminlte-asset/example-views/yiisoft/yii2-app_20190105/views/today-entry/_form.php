<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TodayEntry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="today-entry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'module')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'trn_ref_no')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'trn_dt')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'entry_sr_no')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'ac_no')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'ac_branch')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'event_sr_no')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'event')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'amount_tag')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'drcr_ind')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'trn_code')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'related_customer')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'batch_number')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'product')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'value_dt')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'finacial_year')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'period_code')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'maker_id')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'maker_stamptime')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'checker_id')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'auth_stat')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'delete_stat')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'instrument_code')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
