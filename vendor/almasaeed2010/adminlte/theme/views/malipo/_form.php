<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Malipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="malipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'voucher_id')->textInput() ?>

    <?= $form->field($model, 'siku_kwanza')->textInput() ?>

    <?= $form->field($model, 'siku_pili')->textInput() ?>

    <?= $form->field($model, 'siku_mwisho')->textInput() ?>

    <?= $form->field($model, 'shehia_id')->textInput() ?>

    <?= $form->field($model, 'mzee_id')->textInput() ?>

    <?= $form->field($model, 'kiasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarehe_kulipwa')->textInput() ?>

    <?= $form->field($model, 'cashier_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'device_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kituo_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'aliyelipwa')->textInput() ?>

    <?= $form->field($model, 'muda')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
