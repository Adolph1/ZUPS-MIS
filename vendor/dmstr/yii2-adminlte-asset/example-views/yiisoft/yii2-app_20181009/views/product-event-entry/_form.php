<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductEventEntry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-event-entry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_code')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'transaction_code')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'dr_cr_indicator')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'event_code')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'account_role_code')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'role_type')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'mis_head')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
