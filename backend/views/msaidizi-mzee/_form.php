<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;

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
    <div id="loader1" style="display: none"></div>
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
                    'format' => 'yyyy-mm-dd',

                ],

            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'uhusiano_id')->dropDownList(\backend\models\Uhusiano::getAll(), ['prompt' => '--Chagua--']) ?>
        </div>
    </div>

    <?php
    if(Yii::$app->user->can('DataClerk')) {
        ?>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

                <?= $model->isNewRecord ? $form->field($model, 'mkoa_id')->dropDownList(\backend\models\Mkoa::getRegionBYUSerID(Yii::$app->user->identity->user_id),['readonly' => 'readonly']) : $form->field($model, 'mkoa_id')->dropDownList(\backend\models\Mkoa::getRegionByID($model->mkoa_id),['readonly' => 'readonly']) ?>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <?=  $model->isNewRecord ? $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getDistrictBYUSerID(Yii::$app->user->identity->user_id),['readonly' => 'readonly']) : $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getDistrictBYID($model->wilaya_id),['readonly' => 'readonly'])?>
            </div>

        </div>
        <?php
    }else {

        ?>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

                <?= $form->field($model, 'mkoa_id')->dropDownList(\backend\models\Mkoa::getAll(), ['prompt' => '--Chagua mkoa--']) ?>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <?= $model->isNewRecord ? $form->field($model, 'wilaya_id')->dropDownList(['prompt' => '--Chagua Wilaya--']) : $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAllByRegionID($model->mkoa_id), ['prompt' => '--Chagua Wilaya--']) ?>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="row">
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
