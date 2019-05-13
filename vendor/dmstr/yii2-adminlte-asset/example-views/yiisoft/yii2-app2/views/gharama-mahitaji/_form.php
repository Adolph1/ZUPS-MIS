<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GharamaMahitaji */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gharama-mahitaji-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'budget_id')->textInput() ?>

    <?= $form->field($model, 'hitaji_id')->textInput() ?>

    <?= $form->field($model, 'wilaya_id')->textInput() ?>

    <?= $form->field($model, 'idadi_ya_siku')->textInput() ?>

    <?= $form->field($model, 'idadi_ya_vitu')->textInput() ?>

    <?= $form->field($model, 'gharama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aliyeweka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'muda')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
