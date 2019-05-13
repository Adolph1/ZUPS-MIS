<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductAccrole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-accrole-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_role')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'product_code')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'role_type')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'account_head')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
