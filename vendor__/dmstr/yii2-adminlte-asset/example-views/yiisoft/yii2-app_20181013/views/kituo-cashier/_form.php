<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KituoCashier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kituo-cashier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cashier_id')->textInput() ?>

    <?= $form->field($model, 'kituo_id')->textInput() ?>

    <?= $form->field($model, 'aliyeweka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'muda')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
