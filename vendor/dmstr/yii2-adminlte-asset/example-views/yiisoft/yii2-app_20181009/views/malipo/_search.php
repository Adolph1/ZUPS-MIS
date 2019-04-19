<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MalipoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="malipo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'voucher_id') ?>

    <?= $form->field($model, 'siku_kwanza') ?>

    <?= $form->field($model, 'siku_pili') ?>

    <?= $form->field($model, 'siku_mwisho') ?>

    <?php // echo $form->field($model, 'shehia_id') ?>

    <?php // echo $form->field($model, 'mzee_id') ?>

    <?php // echo $form->field($model, 'kiasi') ?>

    <?php // echo $form->field($model, 'tarehe_kulipwa') ?>

    <?php // echo $form->field($model, 'cashier_id') ?>

    <?php // echo $form->field($model, 'device_number') ?>

    <?php // echo $form->field($model, 'kituo_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'aliyelipwa') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
