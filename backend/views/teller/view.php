<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Teller */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-6">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file-o"></i><strong> ZUPS - MAELEZO YA MUAMALA</strong></h3>
    </div>
    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 text-right">

        <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> Muamala Mpya'), ['create'], ['class' =>yii::$app->User->can('FT-input') ? 'btn btn-default text-green enabled':'btn btn-default text-green disabled']) ?>


        <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> Orodha ya Miamala'), ['index'], ['class' => 'btn btn-default text-green']) ?>


    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
    <?php $form = ActiveForm::begin(); ?>

    <div class="panel-body">
        <legend class="scheduler-border" style="color:#005DAD">Transaction Details</legend>
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'product')->dropDownList(\backend\models\Product::getAll(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>

            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'reference')->textInput(['maxlength' => 200,'readonly'=>'readonly']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">

                <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'readonly'=>'readonly',]) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'related_customer')->dropDownList(\backend\models\Wafanyakazi::getAll(Yii::$app->user->identity->user_id),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'txn_account')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>
            <div class="col-md-4">

                <?= $form->field($model, 'pay_point_id')->dropDownList(\backend\models\Vituo::getAll(),['prompt'=>Yii::t('app','--Select--'),'disabled'=>'disabled']) ?>
            </div>

        </div>

        <div class="row">
            <div class="col-md-2">
                <?php if(!$model->isNewRecord) echo $form->field($model, 'maker_id')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>
            <div class="col-md-2">
                <?php if(!$model->isNewRecord) echo $form->field($model, 'maker_time')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>
            <div class="col-md-4">
                <?php if(!$model->isNewRecord) echo $form->field($model, 'status')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>

            <div class="col-md-2">
                <?php if(!$model->isNewRecord) echo $form->field($model, 'checker_id')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>

            <div class="col-md-2">
                <?php if(!$model->isNewRecord) echo $form->field($model, 'checker_time')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php  //if(!$model->isNewRecord) echo $form->field($model, 'current_balance')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>\backend\models\AccdailyBal::getCurrentBalance($model->txn_account)]) ?>
            </div>

        </div>

    </div>

    <div class="form-group">
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
        <?php
        if($model->status == 'U') {
            ?>
            <?= Html::a(Yii::t('app', 'Futa muamala huu'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Unahukakika unataka kufuta muamala huu?'),
                    'method' => 'post',
                ],
            ]) ?>
            <?php
        }elseif ($model->status == 'A'){
            echo Html::a(Yii::t('app', 'Reverse'), ['reverse', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => Yii::t('app', 'Unahukakika unataka ku-reverse muamala huu?'),
                    'method' => 'post',
                ],
                ]);
        }
        ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
