<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\Wafanyakazi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wafanyakazi-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
        <?= $form->field($model, 'jina_kamili')->textInput(['maxlength' => true,'placeholder' => 'Ingiza jina kamili']) ?>
    </div>
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
        <?= $form->field($model, 'zone_id')->dropDownList(\backend\models\Zone::getAll(),['prompt'=> '--Chagua Zone--']) ?>
    </div>
</div>

    <div class="row">
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
    <?= $model->isNewRecord ? $form->field($model, 'mkoa_id')->dropDownList(['prompt'=> '--Chagua Mkoa--']) : $form->field($model, 'mkoa_id')->dropDownList(\backend\models\Mkoa::getAllByZoneID($model->zone_id),['prompt'=> '--Chagua Mkoa--']) ?>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
    <?= $model->isNewRecord ? $form->field($model, 'wilaya_id')->dropDownList(['prompt'=> '--Chagua Wilaya--']) : $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAllByRegionID($model->mkoa_id),['prompt'=> '--Chagua Wilaya--']) ?>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
    <?= $form->field($model, 'department_id')->dropDownList(\backend\models\Department::getALl(),['prompt' => '--Chagua department--']) ?>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <?= $form->field($model, 'report_to')->dropDownList(['prompt' => '--Chagua mkuu--']) ?>
        </div>
    </div>

    <?= $form->field($model, 'kazi_id')->dropDownList(\backend\models\Kazi::getAll(),['prompt' => '--Chagua Kazi--']) ?>
    <?php
    if($model->isNewRecord) {
        ?>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel panel-heading">
                        Taarifa za kuingia kwenye mfumo
                    </div>
                    <div class="panel panel-body">
                        <?= $form->field($user, 'username')->textInput(['maxlength' => 255, 'placeholder' => 'Username']) ?>

                        <?= $form->field($user, 'password')->passwordInput(['maxlength' => 255, 'placeholder' => 'Password']) ?>

                        <?= $form->field($user, 'repassword')->passwordInput(['maxlength' => 255, 'placeholder' => 'Confirm password']) ?>

                        <?= $form->field($user, 'role')->dropDownList(User::getArrayRole()) ?>

                        <?= $form->field($user, 'status')->dropDownList(User::getArrayStatus()) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
