<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\MiamalaFedha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="miamala-fedha-form">

    <?php $form = ActiveForm::begin(['enableClientValidation'=>false,]); ?>
<div class="row">
    <div class="col-xs-6">
        <?= $form->field($model, 'tarehe_muamala')->widget(
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
    <div class="col-xs-6">
        <?= $form->field($model, 'kiasi')->textInput(['placeholder' => 'Ingiza kiasi']) ?>
    </div>
</div>
    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model, 'aina_ya_muamala')->dropDownList(['D'=>'Kupokea', 'C' => 'Kutoa'],['prompt' => '--chagua aina--'])?>
        </div>
        <div class="col-xs-6">
            <?= $form->field($model, 'mfanyakazi_id')->dropDownList(\backend\models\Wafanyakazi::getAll(Yii::$app->user->identity->user_id),['prompt' => '--Chagua mfanyakazi--']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?= $form->field($model, 'maelezo')->textarea(['rows' => 6,'placeholder' => 'Ingiza maelezo ya muamala']) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
