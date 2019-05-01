<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BidhaaZilizobakiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidhaa-zilizobaki-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bidhaa_id') ?>

    <?= $form->field($model, 'idadi') ?>

    <?= $form->field($model, 'aliyeingiza') ?>

    <?= $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
