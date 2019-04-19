<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use backend\models\User;
/* @var $this yii\web\View */
/* @var $model backend\models\Employee */
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Employee Details</div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($emp, 'first_name')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

            <?= $form->field($emp, 'middle_name')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

            <?= $form->field($emp, 'last_name')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

            <?= $form->field($emp, 'date_of_birth')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            <?= $form->field($emp, 'job_title')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>



            <?php ActiveForm::end(); ?>
        </div>
    </div>

        </div>
        <div class="col-md-6">
        <?php $form = ActiveForm::begin(); ?>
    <div class="user-form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('app', 'Login Details'); ?>
            </div>
            <div class="panel-body">


                <?= $form->field($model, 'username')->textInput(['maxlength' => 255,'readonly'=>'readonly']) ?>
                <?= $form->field($model, 'role')->dropDownList(User::getArrayRole(),['disabled'=>'disabled']) ?>

                <?= $form->field($model, 'status')->dropDownList(User::getArrayStatus(),['disabled'=>'disabled']) ?>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

                <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => 255]) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Change Password'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
        </div>
</div>
