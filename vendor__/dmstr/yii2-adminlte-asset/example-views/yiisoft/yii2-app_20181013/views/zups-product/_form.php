<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ZupsProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zups-product-form">

    <?php $form = ActiveForm::begin(); ?>

   <div class="row">
       <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
           <?= $form->field($model, 'product_code')->textInput(['maxlength' => true]) ?>
       </div>
       <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
           <?= $form->field($model, 'miaka')->textInput() ?>
       </div>
       <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
           <?= $form->field($model, 'kiasi')->textInput(['maxlength' => true]) ?>
       </div>
   </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'maelezo')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <?= !$model->isNewRecord ? $form->field($model, 'status')->dropDownList(\backend\models\ZupsProduct::getArrayStatus()) : " " ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
