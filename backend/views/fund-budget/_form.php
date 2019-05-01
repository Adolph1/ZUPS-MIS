<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FundBudget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fund-budget-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'budget_id')->dropDownList(\backend\models\Budget::getAll(),['prompt' => '--Chagua--']) ?>

    <?= $form->field($model, 'wazee')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'uendeshaji')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'jumla')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'kiasi_kilichotolewa')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
