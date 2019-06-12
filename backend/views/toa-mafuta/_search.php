<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ToaMafutaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="toa-mafuta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tarehe') ?>

    <?= $form->field($model, 'wilaya_id') ?>

    <?= $form->field($model, 'bidhaa_id') ?>

    <?= $form->field($model, 'gari') ?>

    <?php // echo $form->field($model, 'kiasi') ?>

    <?php // echo $form->field($model, 'vocha') ?>

    <?php // echo $form->field($model, 'maker_id') ?>

    <?php // echo $form->field($model, 'maker_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
