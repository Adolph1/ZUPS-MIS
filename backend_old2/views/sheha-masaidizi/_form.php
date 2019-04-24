<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ShehaMasaidizi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sheha-masaidizi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sheha_id')->textInput() ?>

    <?= $form->field($model, 'jina_kamili')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarehe_kuzaliwa')->textInput() ?>

    <?= $form->field($model, 'anuani_kamili')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nambari_ya_simu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aliyeweka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'muda')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
