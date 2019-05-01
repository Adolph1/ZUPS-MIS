<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KituoMonthlyBalancesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kituo-monthly-balances-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kituo_id') ?>

    <?= $form->field($model, 'allocated_amount') ?>

    <?= $form->field($model, 'paid_amount') ?>

    <?= $form->field($model, 'balance') ?>

    <?php // echo $form->field($model, 'month') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'allocated_by') ?>

    <?php // echo $form->field($model, 'allocated_time') ?>

    <?php // echo $form->field($model, 'allocated_to') ?>

    <?php // echo $form->field($model, 'last_access') ?>

    <?php // echo $form->field($model, 'last_access_user') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
