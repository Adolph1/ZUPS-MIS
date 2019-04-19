<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MahesabuYaliofungwa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mahesabu-yaliofungwa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tarehe_ya_kupewa')->textInput() ?>

    <?= $form->field($model, 'cashier_id')->textInput() ?>

    <?= $form->field($model, 'kituo_id')->textInput() ?>

    <?= $form->field($model, 'kiasi_alichopewa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kiasi_kilichotumika')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kiasi_alichorudisha')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kiasi_kilichobaki')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarehe_ya_kufunga')->textInput() ?>

    <?= $form->field($model, 'maelezo_zaid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aliyepokea')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'muda')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
