<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ShehaMasaidiziSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sheha-masaidizi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sheha_id') ?>

    <?= $form->field($model, 'jina_kamili') ?>

    <?= $form->field($model, 'tarehe_kuzaliwa') ?>

    <?= $form->field($model, 'anuani_kamili') ?>

    <?php // echo $form->field($model, 'nambari_ya_simu') ?>

    <?php // echo $form->field($model, 'aliyeweka') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
