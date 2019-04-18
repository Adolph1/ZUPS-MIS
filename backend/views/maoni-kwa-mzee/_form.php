<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MaoniKwaMzee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maoni-kwa-mzee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mzee_id')->textInput() ?>

    <?= $form->field($model, 'sababu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aliyeweka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'muda')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
