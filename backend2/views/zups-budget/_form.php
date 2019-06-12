<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ZupsBudget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zups-budget-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mwezi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mwaka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumla_iliyoombwa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumla_iliyotolewa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bakaa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'aliyeingiza')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'muda')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
