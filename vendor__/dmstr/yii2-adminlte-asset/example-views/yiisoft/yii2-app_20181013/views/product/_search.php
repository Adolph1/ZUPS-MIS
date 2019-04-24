<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'product_descption') ?>

    <?= $form->field($model, 'product_type') ?>

    <?= $form->field($model, 'product_module') ?>

    <?= $form->field($model, 'product_remarks') ?>

    <?php // echo $form->field($model, 'product_start_date') ?>

    <?php // echo $form->field($model, 'product_end_date') ?>

    <?php // echo $form->field($model, 'product_group') ?>

    <?php // echo $form->field($model, 'maker_id') ?>

    <?php // echo $form->field($model, 'maker_stamptime') ?>

    <?php // echo $form->field($model, 'checker_id') ?>

    <?php // echo $form->field($model, 'checker_stamptime') ?>

    <?php // echo $form->field($model, 'record_stat') ?>

    <?php // echo $form->field($model, 'mod_no') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
