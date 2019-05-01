<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WafanyakaziSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wafanyakazi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'jina_kamili') ?>

    <?= $form->field($model, 'department_id') ?>

    <?= $form->field($model, 'wilaya_id') ?>

    <?= $form->field($model, 'kazi_id') ?>

    <?php // echo $form->field($model, 'report_to') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'aliyeweka') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
