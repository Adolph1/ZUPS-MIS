<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\User;

?>
<div class="employee-view">

    <div class="row">
        <div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Taarifa Zangu</div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($emp, 'jina_kamili')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

            <?= $form->field($emp, 'zone_id')->textInput(['maxlength' => true,'readonly'=>'readonly','value' => $emp->zone->jina]) ?>

            <?= $form->field($emp, 'mkoa_id')->textInput(['maxlength' => true,'readonly'=>'readonly','value' => $emp->mkoa->jina]) ?>

            <?= $form->field($emp, 'wilaya_id')->textInput(['maxlength' => true,'readonly'=>'readonly','value' => $emp->wilaya->jina]) ?>

            <?= $form->field($emp, 'department_id')->textInput(['maxlength' => true,'readonly'=>'readonly','value' => $emp->department->jina]) ?>
            <?= $form->field($emp, 'kazi_id')->textInput(['maxlength' => true,'readonly'=>'readonly','value' => $emp->kazi->jina]) ?>




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
