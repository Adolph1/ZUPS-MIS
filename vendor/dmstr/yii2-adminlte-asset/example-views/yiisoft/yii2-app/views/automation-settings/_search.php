<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AutomationSettingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="automation-settings-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'zone_id') ?>

    <?= $form->field($model, 'malipo_kwanza') ?>

    <?= $form->field($model, 'malipo_ya_mwisho') ?>

    <?= $form->field($model, 'mwisho_kuaandaa_voucher') ?>

    <?php // echo $form->field($model, 'muda_wa_voucher') ?>

    <?php // echo $form->field($model, 'aliyeweka') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
