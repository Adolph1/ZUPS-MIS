<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Voucher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="voucher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tarehe_kuandaliwa')->textInput() ?>

    <?= $form->field($model, 'zone_id')->textInput() ?>

    <?= $form->field($model, 'kumbukumbu_namba')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mwezi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mwaka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eligible')->textInput() ?>

    <?= $form->field($model, 'jumla_fedha')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumla_iliyolipwa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumla_iliyobaki')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'aliyeandaa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'muda')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
