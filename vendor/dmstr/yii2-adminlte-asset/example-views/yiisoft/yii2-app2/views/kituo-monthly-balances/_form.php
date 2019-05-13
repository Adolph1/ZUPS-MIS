<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KituoMonthlyBalances */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kituo-monthly-balances-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kituo_id')->textInput() ?>

    <?= $form->field($model, 'allocated_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paid_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'month')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'allocated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'allocated_time')->textInput() ?>

    <?= $form->field($model, 'allocated_to')->textInput() ?>

    <?= $form->field($model, 'last_access')->textInput() ?>

    <?= $form->field($model, 'last_access_user')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
