<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MahesabuBreakdown */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mahesabu-breakdown-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mahesabu_id')->textInput() ?>

    <?= $form->field($model, 'kiasi_kilichobaki')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarehe')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
