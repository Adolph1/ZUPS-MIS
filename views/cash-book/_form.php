<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\CashBook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cash-book-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">

            <?= $form->field($model, 'reference_no')->textInput(['readonly' => 'readonly']) ?>
        </div>
        <div class="col-md-4">
        </div>
    </div>


    <div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'trn_dt')->widget(
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
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'placeholder'=>'Ingiza Kiasi']) ?>
    </div>
</div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'gl_account')->dropDownList(\backend\models\GeneralLedger::getAll(),['prompt' => '--Chagua GL']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'dr_cr')->dropDownList(['C' => 'IN','D'=>'OUT'],['prompt' => '--Chagua--']) ?>
        </div>

    </div>


    <div class="row">
        <div class="col-md-12">

    <?= $form->field($model, 'description')->textarea(['placeholder' => 'Ingiza maelezo']) ?>
        </div>
    </div>


    <div class="row" style="margin-bottom: 10px">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
