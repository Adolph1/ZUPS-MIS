<?php

use yii\bootstrap\Modal;
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
        <div class="col-xs-6">
           <?php if($model->status != 'P' && $model->status != 'C') { ?>
               <?= $form->field($model, 'kiasi_alichorudisha')->textInput(['maxlength' => true]) ?>
               <?php
           }else { ?>
               <?= $form->field($model, 'kiasi_alichorudisha')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
               <?php
           }
           ?>
        </div>

        </div>


    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                <?php
                if($model->status != 'C') {
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
        <?php
        $breakdown = \backend\models\MahesabuBreakdown::findOne(['mahesabu_id'=>$model->id]);
        if($breakdown != null) {
            ?>
            <div class="col-md-6">

                <div class="lead">Pesa ambazo hazijarejeshwa na karani huyu</div>
                <?= Yii::$app->formatter->asDecimal($breakdown->kiasi_kilichobaki, 2); ?>
            </div>
            <div class="col-md-6">
                <?php

                Modal::begin([
                    'header' => '<h3 class="text text-primary">Fomu yamarejesho</h3>',
                    'toggleButton' => ['label' => ' <i class="fa fa-bank"></i> Rejesha Fedha', 'class' => 'btn btn-success',],
                    'size' => Modal::SIZE_SMALL,
                    'options' => ['class' => 'slide', 'id' => 'modal-2'],
                ]);
                ?>
                <div class="maoni-kwa-mzee-form">

                    <?php $form = ActiveForm::begin(['action' => ['marejesho/create','id' => $model->id]]); ?>

                   <?= $form->field($marejesho, 'kiasi')->widget(\kartik\number\NumberControl::classname(), [
                    'maskedInputOptions' => [
                   // 'prefix' => 'TZS ',
                    // 'suffix' => ' ¢',
                    'allowMinus' => false
                    ],


                    ]);?>
                    <?= $form->field($marejesho, 'mahesabu_id')->hiddenInput()->label(false) ?>


                    <div class="form-group text-right">


                        <?= Html::submitButton($marejesho->isNewRecord ? Yii::t('app', 'Ingiza') : Yii::t('app', 'Update'), ['class' => $marejesho->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
                <?php
                Modal::end();
                ?>
            </div>
            <?php
        }
        ?>
    </div>

</div>

