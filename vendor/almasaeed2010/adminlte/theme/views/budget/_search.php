<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BudgetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="budget-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'maelezo') ?>

    <?= $form->field($model, 'jumla_kiasi') ?>

    <?= $form->field($model, 'kumbukumbu_no') ?>

    <?= $form->field($model, 'kwa_mwezi') ?>

    <?php // echo $form->field($model, 'kwa_mwaka') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'aliyeweka') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <?php // echo $form->field($model, 'aliyethitisha') ?>

    <?php // echo $form->field($model, 'muda_kuthibitisha') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
