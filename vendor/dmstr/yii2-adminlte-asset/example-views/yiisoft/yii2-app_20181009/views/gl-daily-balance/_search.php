<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GlDailyBalanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gl-daily-balance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'trn_date') ?>

    <?= $form->field($model, 'gl_code') ?>

    <?= $form->field($model, 'opening_balance') ?>

    <?= $form->field($model, 'dr_turn') ?>

    <?php // echo $form->field($model, 'cr_turn') ?>

    <?php // echo $form->field($model, 'closing_balance') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
