<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\MsaidiziMzee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="msaidizi-mzee-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
       <div class="col-md-6">
           <?= $form->field($model, 'jina_kamili')->textInput(['maxlength' => true,'placeholder' => 'Ingiza jina kamili']) ?>
       </div>
        <div class="col-md-6">
            <?= $form->field($model, 'jinsia')->dropDownList(['M' => 'MWANAUME', 'F' => 'MWANAMKE'], ['prompt' => '--Chagua--']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'anuani')->textInput(['maxlength' => true,'placeholder' => 'Ingiza anuani']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'simu')->textInput(['maxlength' => true,'placeholder' => 'Ingiza namba ya simu']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'aina_ya_kitambulisho')->dropDownList(\backend\models\AinaYaKitambulisho::getAll(), ['prompt' => '--Chagua--', 'id' => 'msaidiz-aina']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'nambari_ya_kitambulisho')->textInput(['maxlength' => true,'placeholder' => 'Ingiza nambari ya kitambulisho']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tarehe_kuzaliwa')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'options' => ['placeholder' => 'Ingiza tarehe ya kuzaliwa', 'id' => 'kuzaliwa'],
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy',

                ],

            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'uhusiano_id')->dropDownList(\backend\models\Uhusiano::getAll(), ['prompt' => '--Chagua--']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'msaidizi_power')->fileInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">

            <?= $form->field($model, 'tarehe_mwisho_power')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'options' => ['placeholder' => 'Tarehe ya mwisho ya power of attorney', 'id' => 'power-id'],
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy',

                ],

            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'msaidizi_picha')->fileInput(['maxlength' => true]) ?>
        </div>

    </div>




    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
