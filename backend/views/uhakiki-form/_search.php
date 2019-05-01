<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UhakikiFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uhakiki-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tarehe_ya_uhakiki') ?>

    <?= $form->field($model, 'aliyemhakiki') ?>

    <?= $form->field($model, 'mzee_id') ?>

    <?= $form->field($model, 'maoni_ya_uhakiki') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
