<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jina')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'namba_ya_simu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mtaa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aina_ya_biashara')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
