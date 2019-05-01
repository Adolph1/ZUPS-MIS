<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MiamalaWatendajiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="miamala-watendaji-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tarehe_ya_kupewa') ?>

    <?= $form->field($model, 'cashier_id') ?>

    <?= $form->field($model, 'kituo_id') ?>

    <?= $form->field($model, 'kiasi') ?>

    <?php // echo $form->field($model, 'jumla_watendaji') ?>

    <?php // echo $form->field($model, 'kiasi_kilicholipwa') ?>

    <?php // echo $form->field($model, 'kiasi_kilichobaki') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
