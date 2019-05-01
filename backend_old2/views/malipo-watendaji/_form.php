<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\MalipoWatendaji */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="malipo-watendaji-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'muamala_id')->hiddenInput()->label(false) ?>


    <?= $form->field($model, 'tarehe_ya_kulipwa')->widget(
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

    <?= $form->field($model, 'jina_kamili')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kiasi_alichopewa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kazi_yake')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Ingiza' : 'Rekebisha', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
