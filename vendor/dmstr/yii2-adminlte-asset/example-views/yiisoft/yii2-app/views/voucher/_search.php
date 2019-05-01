<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VoucherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="voucher-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tarehe_kuandaliwa') ?>

    <?= $form->field($model, 'zone_id') ?>

    <?= $form->field($model, 'kumbukumbu_namba') ?>

    <?= $form->field($model, 'mwezi') ?>

    <?php // echo $form->field($model, 'mwaka') ?>

    <?php // echo $form->field($model, 'eligible') ?>

    <?php // echo $form->field($model, 'jumla_fedha') ?>

    <?php // echo $form->field($model, 'jumla_iliyolipwa') ?>

    <?php // echo $form->field($model, 'jumla_iliyobaki') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'aliyeandaa') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
