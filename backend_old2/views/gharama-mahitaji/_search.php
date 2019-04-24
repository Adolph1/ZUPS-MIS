<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GharamaMahitajiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gharama-mahitaji-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'budget_id') ?>

    <?= $form->field($model, 'hitaji_id') ?>

    <?= $form->field($model, 'wilaya_id') ?>

    <?= $form->field($model, 'idadi_ya_siku') ?>

    <?php // echo $form->field($model, 'idadi_ya_vitu') ?>

    <?php // echo $form->field($model, 'gharama') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'aliyeweka') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
