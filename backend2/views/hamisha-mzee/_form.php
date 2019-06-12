<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\HamishaMzee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hamisha-mzee-form">
    <div id="loader1" style="display: none"></div>
    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model, 'mzee_id')->widget(Select2::classname(), [
        'data' => \backend\models\Mzee::getAll(),
        'language' => 'en',
        'options' => ['placeholder' => 'Chagua mzee ...',],
        'pluginOptions' => [
            'allowClear' => false,

        ],
    ])->label(false);


    ?>
    <?php
    echo $form->field($model, 'mkoa_anaokwenda')->widget(Select2::classname(), [
        'data' => \backend\models\Mkoa::getOtherZone(),
        'language' => 'en',
        'options' => ['placeholder' => 'Chagua mkoa anaokwenda...','id' => 'to-mkoa-id'],
        'pluginOptions' => [
            'allowClear' => false,

        ],
    ])->label(false);


    ?>

    <?= $model->isNewRecord ? $form->field($model, 'wilaya_anayokwenda')->dropDownList(['prompt' => '--Chagua Wilaya--']) : $form->field($model, 'wilaya_anayokwenda')->dropDownList(\backend\models\Wilaya::getAllByRegionID($model->mkoa_id), ['prompt' => '--Chagua Wilaya--']) ?>

    <?=
    $model->isNewRecord ?
        $form->field($model, 'shehia_anayokwenda')->widget(Select2::classname(), [
            // 'data' => '',
            'language' => 'en',
            'options' => ['placeholder' => 'Chagua shehia anayokwenda ...',],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ])
        :
        $form->field($model, 'shehia_anayokwenda')->widget(Select2::classname(), [
            'data' => \backend\models\Shehia::getAllByWilayaID($model->wilaya_id),
            'language' => 'en',
            'options' => ['placeholder' => 'Chagua anayokwenda ...',],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?= $form->field($model, 'sababu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tarehe')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'options' => ['placeholder' => 'Ingiza tarehe ya kuhama'],
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',

        ],

    ]) ?>



    <div class="row" style="margin-bottom: 10px">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '<i class="fa fa-save"></i> Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
