<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MsaidiziMzeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="msaidizi-mzee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'jina_kamili') ?>

    <?= $form->field($model, 'jinsia') ?>

    <?= $form->field($model, 'mzee_id') ?>

    <?= $form->field($model, 'picha') ?>

    <?php // echo $form->field($model, 'anuani') ?>

    <?php // echo $form->field($model, 'tarehe_kuzaliwa') ?>

    <?php // echo $form->field($model, 'aina_ya_kitambulisho') ?>

    <?php // echo $form->field($model, 'nambari_ya_kitambulisho') ?>

    <?php // echo $form->field($model, 'uhusiano_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'aliyemuweka') ?>

    <?php // echo $form->field($model, 'power_of_attorney') ?>

    <?php // echo $form->field($model, 'tarehe_mwisho_power') ?>

    <?php // echo $form->field($model, 'finger_print') ?>

    <?php // echo $form->field($model, 'power_status') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
