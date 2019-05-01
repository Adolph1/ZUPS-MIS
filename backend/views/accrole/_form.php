<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Accrole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accrole-form">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('app', 'Account role Form'); ?>
            </div>
            <div class="panel-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'role_code')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'role_description')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'role_type')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'module')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
