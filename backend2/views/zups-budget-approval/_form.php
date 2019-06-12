<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ZupsBudgetApproval */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zups-budget-approval-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'zups_budget_id')->textInput() ?>

    <?= $form->field($model, 'maker')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'muda')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
