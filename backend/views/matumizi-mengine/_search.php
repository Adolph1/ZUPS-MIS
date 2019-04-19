<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MatumiziMengineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matumizi-mengine-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tarehe') ?>

    <?= $form->field($model, 'aina_ya_matumizi') ?>

    <?= $form->field($model, 'kiasi') ?>

    <?= $form->field($model, 'stakabadhi') ?>

    <?php // echo $form->field($model, 'aliyetumia') ?>

    <?php // echo $form->field($model, 'malezo') ?>

    <?php // echo $form->field($model, 'aliyeweka') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
