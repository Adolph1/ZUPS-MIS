<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ZupsBudgetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zups-budget-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mwezi') ?>

    <?= $form->field($model, 'mwaka') ?>

    <?= $form->field($model, 'jumla_iliyoombwa') ?>

    <?= $form->field($model, 'jumla_iliyotolewa') ?>

    <?php // echo $form->field($model, 'bakaa') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'aliyeingiza') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
