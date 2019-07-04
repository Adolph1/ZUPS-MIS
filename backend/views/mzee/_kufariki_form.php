<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Mzee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mzee-form">
    <div class="panel panel-primary">
        <div class="panel panel-heading">Ingiza mzee aliyefariki</div>
        <div class="panel panel-body">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" >

            <?php $form = ActiveForm::begin(); ?>
           <?= $form->field($model, 'id')->widget(Select2::classname(), [
             'data' => \backend\models\Mzee::getAll(),
            'language' => 'en',
            'options' => ['placeholder' => 'Chagua mzee ...',],
            'pluginOptions' => [
            'allowClear' => false
            ],
            ])->label(false)?>
            <?= $form->field($model, 'death_reported_date')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',

                ],
                'options' => ['placeholder' => 'Ingiza tarehe ya kupokea taarifa']
            ])?>

            <?= $form->field($model, 'tarehe_kufariki')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',

                ],
                'options' => ['placeholder' => 'Ingiza tarehe ya kufariki']
            ])?>
            <?= $form->field($model, 'aliyeleta_taarifa_kifo')->textInput(['maxlength' => true,]) ?>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Ingiza') : Yii::t('app', 'Ingiza'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>


        </div>
    </div>
        </div>
    </div>
</div>