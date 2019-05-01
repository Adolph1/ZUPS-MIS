<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ZupsBudgetApprovalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zups-budget-approval-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'zups_budget_id') ?>

    <?= $form->field($model, 'maker') ?>

    <?= $form->field($model, 'stage') ?>

    <?= $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
