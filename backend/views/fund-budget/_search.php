<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FundBudgetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fund-budget-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'budget_id') ?>

    <?= $form->field($model, 'wazee') ?>

    <?= $form->field($model, 'uendeshaji') ?>

    <?= $form->field($model, 'jumla') ?>

    <?php // echo $form->field($model, 'kiasi_kilichotolewa') ?>

    <?php // echo $form->field($model, 'bakaa') ?>

    <?php // echo $form->field($model, 'aliyeingiza') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
