<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TodayEntrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="today-entry-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'module') ?>

    <?= $form->field($model, 'trn_ref_no') ?>

    <?= $form->field($model, 'trn_dt') ?>

    <?= $form->field($model, 'entry_sr_no') ?>

    <?php // echo $form->field($model, 'ac_no') ?>

    <?php // echo $form->field($model, 'ac_branch') ?>

    <?php // echo $form->field($model, 'event_sr_no') ?>

    <?php // echo $form->field($model, 'event') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'amount_tag') ?>

    <?php // echo $form->field($model, 'drcr_ind') ?>

    <?php // echo $form->field($model, 'trn_code') ?>

    <?php // echo $form->field($model, 'related_customer') ?>

    <?php // echo $form->field($model, 'batch_no') ?>

    <?php // echo $form->field($model, 'product') ?>

    <?php // echo $form->field($model, 'value_dt') ?>

    <?php // echo $form->field($model, 'finacial_year') ?>

    <?php // echo $form->field($model, 'period_code') ?>

    <?php // echo $form->field($model, 'maker_id') ?>

    <?php // echo $form->field($model, 'maker_stamptime') ?>

    <?php // echo $form->field($model, 'checker_id') ?>

    <?php // echo $form->field($model, 'auth_stat') ?>

    <?php // echo $form->field($model, 'delete_stat') ?>

    <?php // echo $form->field($model, 'instrument_code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
