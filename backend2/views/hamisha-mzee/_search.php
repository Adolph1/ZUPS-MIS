<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HamishaMzeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hamisha-mzee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mzee_id') ?>

    <?= $form->field($model, 'mkoa_anaokwenda') ?>

    <?= $form->field($model, 'wilaya_anayokwenda') ?>

    <?= $form->field($model, 'shehia_anayokwenda') ?>

    <?php // echo $form->field($model, 'sababu') ?>

    <?php // echo $form->field($model, 'mkoa_aliotoka') ?>

    <?php // echo $form->field($model, 'wilaya_aliyotoka') ?>

    <?php // echo $form->field($model, 'shehia_aliyotoka') ?>

    <?php // echo $form->field($model, 'tarehe') ?>

    <?php // echo $form->field($model, 'aliyeingiza') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
