<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OfficeSupervisor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="office-supervisor-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
        <?= $form->field($model, 'aina_id')->dropDownList(\backend\models\AinaYaMatumizi::getAll(),['prompt'=> '--Chagua--']) ?>

    </div>
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
        <?= $form->field($model, 'budget_number')->textInput(['readonly' => 'readonly']) ?>
    </div>
</div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <?= $form->field($model, 'kiasi')->textInput(['maxlength' => true,'placeholder' => '0.00']) ?>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

            <?= $form->field($model, 'kiambatanisho')->fileInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, 'maelezo')->textarea(['rows' => 6,'placeholder' => 'Ingiza maelezo ya matumizi']) ?>
    <?= $form->field($model, 'budget_id')->hiddenInput(['maxlength' => true])->label(false) ?>


    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
