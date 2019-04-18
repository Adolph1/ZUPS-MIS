<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Audit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="audit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'module')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'new')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_time')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
