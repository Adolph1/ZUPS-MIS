<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SystemModule;

/* @var $this yii\web\View */
/* @var $model backend\models\Report */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-form">
    <div class="panel panel-success">
        <div class="panel-heading">Report Form</div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'report_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'module')->dropDownList(SystemModule::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>

            <?= $form->field($model, 'status')->dropDownList(['1'=>'Active','0'=>'Disable'],['prompt'=>'--Select--']) ?>
            <?= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
