<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MahesabuYaliofungwa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mahesabu-yaliofungwa-form">
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - FOMU YA KUFUNGA MAHESABU</strong>
        </div>
        <div class="col-md-3">

        </div>

    </div>
    <hr/>
    <?php $form = ActiveForm::begin(['action' => ['update','id' => $model->id]]); ?>
<div class="row">
    <div class="col-xs-6">
        <?= $form->field($model, 'tarehe_ya_kupewa')->textInput(['readonly' => 'readonly']) ?>
    </div>
    <div class="col-xs-3">
        <?= $form->field($model, 'jina_la_karani')->textInput(['readonly' => 'readonly','value' => $model->cashier->jina_kamili]) ?>
    </div>
    <div class="col-xs-3">
        <?= $form->field($model, 'jina_la_kituo')->textInput(['readonly' => 'readonly','value' => $model->kituo->kituo]) ?>
    </div>
</div>
    <div class="row">

        <div class="col-xs-3">
            <?= $form->field($model, 'kiasi_alichopewa')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
        </div>
        <div class="col-xs-3">
        <?= $form->field($model, 'kiasi_kilichotumika')->textInput(['maxlength' => true,'readonly' => 'readonly','value' => \backend\models\Malipo::getSumPerCashierID(\backend\models\CashierAccount::getCustomerNumberByAccount(\backend\models\CashierAccount::geAccountByUserId($model->cashier_id)),$model->tarehe_ya_kupewa)]) ?>

        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'kiasi_alichorudisha')->textInput(['maxlength' => true,'onblur'=>'jsOffsetamount(this)','onkeyup'=>'jsOffsetamount(this)']) ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'kiasi_kilichobaki')->textInput(['maxlength' => true,'readonly' => 'readonly', 'value' => \backend\models\AccdailyBal::getCurrentBalance(\backend\models\CashierAccount::geAccountByUserId($model->cashier_id))]) ?>
        </div>
        </div>

    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model, 'aliyepokea')->textInput(['readonly' => 'readonly']) ?>
        </div>
        <div class="col-xs-6">
            <?= $form->field($model, 'muda')->textInput(['readonly' => 'readonly']) ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                <?php
                if($model->status == 'P') {
                    ?>

                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="row">
        <div class="col-md-12">
            <?php
            $breakdown = \backend\models\MahesabuBreakdown::findOne(['mahesabu_id'=>$model->id]);
            if($breakdown != null){
            ?>
            <div class="lead">Pesa ambazo hazijarejeshwa na karani huyu</div>
            <?= Yii::$app->formatter->asDecimal($breakdown->kiasi_kilichobaki,2); }?>
        </div>
    </div>

</div>

<script>
    function jsOffsetamount(data)
    {
        var alichorudisha=document.getElementById('mahesabuyaliofungwa-kiasi_alichorudisha').value;

        var kilichobaki = document.getElementById('mahesabuyaliofungwa-kiasi_kilichobaki').value;
        var diff = kilichobaki-alichorudisha;
        if(diff >= 0.00) {
            document.getElementById("mahesabuyaliofungwa-kiasi_kilichobaki").value = diff;
        }else {

            document.getElementById('mahesabuyaliofungwa-kiasi_alichorudisha').value=0.00;
            //alert('Hakuna kiasi kinachostahili kurejeshwa');
    }



    }
</script>
