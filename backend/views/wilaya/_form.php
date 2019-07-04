<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Wilaya */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wilaya-form">
    <div class="panel panel-primary">
        <div class="panel panel-heading">Wilaya Fomu</div>
        <div class="panel panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jina')->textInput(['maxlength' => true,'placeholder' => 'Weka jina la wilaya']) ?>

    <?= $form->field($model, 'mkoa_id')->dropDownList(\backend\models\Mkoa::getAll(),['prompt' => '--Chagua Mkoa--']) ?>


    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
