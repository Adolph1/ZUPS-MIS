<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Mkoa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mkoa-form">
    <div class="panel panel-primary">
        <div class="panel panel-heading">Mkoa Fomu</div>
        <div class="panel panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jina')->textInput(['maxlength' => true, 'placeholder' => 'Weka Jina la Mkoa']) ?>

    <?= $form->field($model, 'zone_id')->dropDownList(\backend\models\Zone::getAll(),['prompt' => '--Chagua Zone--']) ?>



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
