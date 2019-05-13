<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ShehaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sheha-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'jina_kamili') ?>

    <?= $form->field($model, 'mtaa') ?>

    <?= $form->field($model, 'nyumba_namba') ?>

    <?= $form->field($model, 'jinsia') ?>

    <?php // echo $form->field($model, 'simu') ?>

    <?php // echo $form->field($model, 'wilaya_id') ?>

    <?php // echo $form->field($model, 'tarehe_kuzaliwa') ?>

    <?php // echo $form->field($model, 'shehia_id') ?>

    <?php // echo $form->field($model, 'aliyeweka') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
