<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\BidhaaZilizotolewa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidhaa-zilizotolewa-form">
    <div id="loader1" style="display: none"></div>
    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'tarehe_ya_kutoka')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',

        ],
        'options'=>['placeholder'=>'Ingiza tarehe ya kutoa']
    ]);?>

    <?= $form->field($model, 'bidhaa_id')->dropDownList(\backend\models\Mahitaji::getAll(),['prompt' => '--Chagua--']) ?>
    <?= $form->field($model, 'jumla')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
    <?= $form->field($model, 'idadi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aliyepokea')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'maelezo_zaidi')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
