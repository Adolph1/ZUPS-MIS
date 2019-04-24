<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductEventEntrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-event-entry-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'product_code') ?>

    <?= $form->field($model, 'transaction_code') ?>

    <?= $form->field($model, 'dr_cr_indicator') ?>

    <?= $form->field($model, 'event_code') ?>

    <?= $form->field($model, 'account_role_code') ?>

    <?php // echo $form->field($model, 'role_type') ?>

    <?php // echo $form->field($model, 'mis_head') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
