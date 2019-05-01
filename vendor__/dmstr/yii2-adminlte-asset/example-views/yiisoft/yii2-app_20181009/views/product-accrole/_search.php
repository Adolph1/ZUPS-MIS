<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductAccroleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-accrole-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'account_role') ?>

    <?= $form->field($model, 'product_code') ?>

    <?= $form->field($model, 'role_type') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'account_head') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
