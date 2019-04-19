<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\BidhaaZilizoingia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidhaa-zilizoingia-form">

    <?php $form = ActiveForm::begin(); ?>
   <?= $form->field($model, 'tarehe_ya_kuingia')->widget(
    DatePicker::className(), [
    // inline too, not bad
    'inline' => false,
    // modify template for custom rendering
    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
    'clientOptions' => [
    'autoclose' => true,
    'format' => 'yyyy-mm-dd',

    ],
    'options' => ['placeholder' => 'Ingiza tarehe ya kuingia','value' => date('Y-m-d')],
    ]);?>

    <?= $form->field($model, 'bidhaa_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'jina_aliyeleta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idadi')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>


    <?= $form->field($model, 'aliyepokea')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
