<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BudgetMonthlyBalance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="budget-monthly-balance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'budget_id')->textInput() ?>

    <?php //$form->field($model, 'opening_balance')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'opening_balance')->widget(\kartik\number\NumberControl::classname(), [
    'maskedInputOptions' => [
    'prefix' => 'TZS ',
    // 'suffix' => ' ¢',
    'allowMinus' => false
    ],
    'displayOptions' => ['readonly' => 'readonly']

    ]);?>

    <?= $form->field($model, 'closing_balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
