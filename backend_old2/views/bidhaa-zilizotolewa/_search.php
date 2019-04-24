<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BidhaaZilizotolewaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidhaa-zilizotolewa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tarehe_ya_kutoka') ?>

    <?= $form->field($model, 'bidhaa_id') ?>

    <?= $form->field($model, 'jina_aliyetoa') ?>

    <?= $form->field($model, 'idadi') ?>

    <?php // echo $form->field($model, 'jumla') ?>

    <?php // echo $form->field($model, 'aliyepokea') ?>

    <?php // echo $form->field($model, 'aliyeingiza') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
