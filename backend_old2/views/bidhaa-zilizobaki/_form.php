<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BidhaaZilizobaki */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidhaa-zilizobaki-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bidhaa_id')->textInput() ?>

    <?= $form->field($model, 'idadi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aliyeingiza')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'muda')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
