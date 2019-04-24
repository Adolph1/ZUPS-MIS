<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Budget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="budget-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
            <?= $form->field($model, 'maelezo')->textInput(['maxlength' => true,'placeholder' => 'Ingiza maelezo kuhusu Budget hii']) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'kumbukumbu_no')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
            <?= $form->field($model, 'kwa_mwezi')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'kwa_mwaka')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
            <?= $form->field($model, 'aliyeweka')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'muda')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
        </div>
    </div>








    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
