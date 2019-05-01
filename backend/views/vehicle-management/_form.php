<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\VehicleManagement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-management-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?php
            if($model->isNewRecord) {
                echo $form->field($model, 'tarehe_ya_kukodi')->widget(
                    DatePicker::className(), [
                    // inline too, not bad
                    'inline' => false,
                    // modify template for custom rendering
                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',

                    ],
                    'options' => ['placeholder' => 'Ingiza tarehe ya kukodi', 'value' => date('Y-m-d')],
                ]);
            }else{
               echo $form->field($model, 'tarehe_ya_kukodi')->widget(
                    DatePicker::className(), [
                    // inline too, not bad
                    'inline' => false,
                    // modify template for custom rendering
                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',

                    ],
                    'options' => ['placeholder' => 'Ingiza tarehe ya kukodi'],
                ]);
            }
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'aina_ya_gari')->textInput(['maxlength' => true,'placeholder' => 'Ingiza aina ya gari']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'plate_number')->textInput(['maxlength' => true,'placeholder' => 'Ingiza plate number']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'mmiliki_wa_gari')->textInput(['maxlength' => true,'placeholder'=>'Ingiza jina la mmiliki wa gari']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'namba_ya_simu_mmiliki')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza namba ya simu ya mmliki wa gari']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'jina_la_dereva')->textInput(['maxlength' => true, 'placeholder'=>'Ingiza jina la dereva']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'namba_ya_simu_dereva')->textInput(['maxlength' => true,'placeholder'=>'Ingiza namba ya simu ya dereva']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
    <?= $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAll(),['prompt' => '--Chagua wilaya--']) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
