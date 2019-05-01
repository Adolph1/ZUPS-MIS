<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VehicleManagementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-management-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tarehe_ya_kukodi') ?>

    <?= $form->field($model, 'mmiliki_wa_gari') ?>

    <?= $form->field($model, 'namba_ya_simu_mmiliki') ?>

    <?= $form->field($model, 'aina_ya_gari') ?>

    <?php // echo $form->field($model, 'plate_number') ?>

    <?php // echo $form->field($model, 'jina_la_dereva') ?>

    <?php // echo $form->field($model, 'namba_ya_simu_dereva') ?>

    <?php // echo $form->field($model, 'kituo_id') ?>

    <?php // echo $form->field($model, 'jumla_ya_fedha_mafuta') ?>

    <?php // echo $form->field($model, 'bei_ya_lita_moja') ?>

    <?php // echo $form->field($model, 'jumla_ya_lita') ?>

    <?php // echo $form->field($model, 'order_number') ?>

    <?php // echo $form->field($model, 'aliyeingiza') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
