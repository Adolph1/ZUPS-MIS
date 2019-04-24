<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MahesabuYaliofungwaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mahesabu-yaliofungwa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tarehe_ya_kupewa') ?>

    <?= $form->field($model, 'cashier_id') ?>

    <?= $form->field($model, 'kituo_id') ?>

    <?= $form->field($model, 'kiasi_alichopewa') ?>

    <?php // echo $form->field($model, 'kiasi_kilichotumika') ?>

    <?php // echo $form->field($model, 'kiasi_alichorudisha') ?>

    <?php // echo $form->field($model, 'kiasi_kilichobaki') ?>

    <?php // echo $form->field($model, 'tarehe_ya_kufunga') ?>

    <?php // echo $form->field($model, 'maelezo_zaid') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'aliyepokea') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
