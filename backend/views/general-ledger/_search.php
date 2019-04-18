<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GeneralLedgerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="general-ledger-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gl_code') ?>

    <?= $form->field($model, 'gl_description') ?>

    <?= $form->field($model, 'parent_gl') ?>

    <?= $form->field($model, 'leaf') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'customer') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'posting_restriction') ?>

    <?php // echo $form->field($model, 'record_status') ?>

    <?php // echo $form->field($model, 'maker_id') ?>

    <?php // echo $form->field($model, 'maker_stamptime') ?>

    <?php // echo $form->field($model, 'checker_id') ?>

    <?php // echo $form->field($model, 'checker_stamptime') ?>

    <?php // echo $form->field($model, 'mod_no') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
