<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\ReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['watendaji'],
        'method' => 'get',
    ]); ?>


   <div class="row">
       <div class="col-md-3">
           <?= $form->field($model, 'date1')->widget(
               DatePicker::className(), [
               // inline too, not bad
               'inline' => false,
               // modify template for custom rendering
               //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
               'clientOptions' => [
                   'autoclose' => true,
                   'format' => 'yyyy-mm-dd',

               ],
               'options'=>['placeholder'=>'Ingiza tarehe ya mwanzo']
           ])->label(false);?>
       </div>
       <div class="col-md-3">
           <?= $form->field($model, 'date2')->widget(
               DatePicker::className(), [
               // inline too, not bad
               'inline' => false,
               // modify template for custom rendering
               //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
               'clientOptions' => [
                   'autoclose' => true,
                   'format' => 'yyyy-mm-dd',

               ],
               'options'=>['placeholder'=>'Ingiza tarehe ya mwisho']
           ])->label(false);?>
       </div>
       <div class="col-md-3">
           <div class="form-group">
               <?= Html::submitButton(Yii::t('app', 'Tafuta'), ['class' => 'btn btn-primary']) ?>
           </div>
       </div>
   </div>






    <?php ActiveForm::end(); ?>

</div>
