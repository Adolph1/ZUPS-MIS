<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UhakikiForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uhakiki-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tarehe_ya_uhakiki')->textInput() ?>

    <?= $form->field($model, 'aliyemhakiki')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mzee_id')->textInput() ?>

    <?= $form->field($model, 'maoni_ya_uhakiki')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
