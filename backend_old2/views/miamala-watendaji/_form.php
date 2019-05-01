<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\MiamalaWatendaji */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="miamala-watendaji-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <?php // $form->field($model, 'product')->dropDownList(\backend\models\Product::getAll(),['prompt'=>Yii::t('app','--chagua--')]) ?>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
        </div>
    </div>
<div class="row">
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <?= $form->field($model, 'tarehe_ya_kupewa')->widget(
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
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <?php
            // Normal select with ActiveForm & model
            echo $form->field($model, 'cashier_id')->widget(Select2::classname(), [
                'data' => \backend\models\MiamalaWatendaji::getCashiers(),
                'language' => 'en',
                'options' => ['placeholder' => 'Chagua karani ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);

            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <?php
            // Normal select with ActiveForm & model
            echo $form->field($model, 'kituo_id')->widget(Select2::classname(), [
                'data' => \backend\models\Vituo::getAll(),
                'language' => 'en',
                'options' => ['placeholder' => 'Chagua kituo ...','id' => 'kituo-id'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);

            ?>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <?= $form->field($model, 'kiasi')->textInput(['maxlength' => true]) ?>
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
