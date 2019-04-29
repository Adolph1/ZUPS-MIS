<?php

use kartik\number\NumberControl;
use kartik\select2\Select2;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/**
 * All the examples below use the following variables for settings
 */
$dispOptions = ['class' => 'form-control kv-monospace'];

$saveOptions = [
    'type' => 'text',
    'label'=>'<label>Saved Value: </label>',
    'class' => 'kv-saved',
    //'readonly' => true,
    'tabindex' => 1000
];

$saveCont = ['class' => 'kv-saved-cont'];
/* @var $this yii\web\View */
/* @var $model backend\models\Teller */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div id="loader1" style="display: none"></div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'trn_dt')->textInput(['readonly' => 'readonly']) ?>

    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'reference')->textInput(['maxlength' => 200,'readonly'=>'readonly']) ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <?php
        // Normal select with ActiveForm & model
        echo $form->field($model, 'cashier_id')->widget(Select2::classname(), [
            'data' => \backend\models\Teller::getCashiers(),
            'language' => 'en',
            'options' => ['placeholder' => 'Chagua cashier ...','id' => 'cashier-id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);

        ?>


    </div>

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?php
        // Normal select with ActiveForm & model
        echo $form->field($model, 'pay_point_id')->widget(Select2::classname(), [
            'data' => \backend\models\Vituo::getNotTaken(),
            'language' => 'en',
            'options' => ['placeholder' => 'Chagua kituo ...','id' => 'kituo-id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);

        ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $form->field($model, 'kituo_balance')->textInput(['maxlength' => 200,'readonly'=>'readonly']) ?>
        <?php        /*$form->field($model, 'kituo_balance')->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
               // 'prefix' => 'Tsh ',
                //'suffix' => ' ¢',
                'allowMinus' => false
            ],
            'name' => 'currency-num',
            'options' => ['readonly' => 'readonly',],
             'displayOptions' => $dispOptions,
             'saveInputContainer' => $saveCont
        ]); */?>
    </div>
</div>
</div>
<div class="panel-body">
    <div id="loader1" style="display: none"></div>

    <div class="row">


        <div class="col-md-6">
            <?= $form->field($model, 'txn_account')->textInput(['maxlength' => true,'readonly'=>'readonly'])?>

        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'readonly' => 'readonly','onblur'=>'jsOffsetamount(this)','onkeyup'=>'jsOffsetamount(this)']) ?>

            <?php /* $form->field($model, 'amount')->widget(NumberControl::classname(), [
            'maskedInputOptions' => [
          //  'prefix' => 'Tsh ',

            //'suffix' => ' ¢',
            'allowMinus' => false
            ],
                'name' => 'currency-num',
            'options' => ['readonly' => 'readonly','onblur'=>'jsOffsetamount(this)','onkeyup'=>'jsOffsetamount(this)'],
            'displayOptions' => $dispOptions,
            'saveInputContainer' => $saveCont
            ]); */?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'offset_account')->hiddenInput(['maxlength' => true,'readonly'=>'readonly'])->label(false) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'offset_amount')->hiddenInput(['maxlength' => true,'readonly'=>'readonly'])->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-9"  id = "pendings">

        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
        </div>




        <?php ActiveForm::end(); ?>
    </div>


    <script>
        function jsOffsetamount(data)
        {
            var amount=document.getElementById('teller-amount').value;


            document.getElementById("teller-offset_amount").value = amount;



        }
    </script>
