<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\FuelManagement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fuel-management-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vehicle_id')->dropDownList(\backend\models\VehicleManagement::getAll(),['prompt' => '--Chagua--']) ?>

    <?= $form->field($model, 'kiasi_cha_mafuta')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'order_number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tarehe')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',

        ],
        'options'=>['placeholder'=>'Ingiza tarehe ya muamala']
    ]);?>

    <?= $form->field($model, 'dereva')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
