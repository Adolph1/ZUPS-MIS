<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MarejeshoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marejesho-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tarehe') ?>

    <?= $form->field($model, 'mahesabu_id') ?>

    <?= $form->field($model, 'kiasi') ?>

    <?= $form->field($model, 'kilichobaki') ?>

    <?php // echo $form->field($model, 'aliyepokea') ?>

    <?php // echo $form->field($model, 'muda_alioingiza') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
