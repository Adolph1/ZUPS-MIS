<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Marejesho */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marejesho-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tarehe')->textInput() ?>

    <?= $form->field($model, 'mahesabu_id')->textInput() ?>

    <?= $form->field($model, 'kiasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kilichobaki')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aliyepokea')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'muda_alioingiza')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
