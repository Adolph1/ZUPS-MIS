<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MalipoMaafisaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="malipo-maafisa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'budget_id') ?>

    <?= $form->field($model, 'zone_id') ?>

    <?= $form->field($model, 'jina_kamili') ?>

    <?= $form->field($model, 'kazi') ?>

    <?php // echo $form->field($model, 'namba_ya_simu') ?>

    <?php // echo $form->field($model, 'kiasi') ?>

    <?php // echo $form->field($model, 'tarehe_ya_malipo') ?>

    <?php // echo $form->field($model, 'kumbukumbu_no') ?>

    <?php // echo $form->field($model, 'aliyeingiza') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <?php // echo $form->field($model, 'ofisi_aliyotoka') ?>

    <?php // echo $form->field($model, 'kazi_anayoenda_kufanya') ?>

    <?php // echo $form->field($model, 'kituo_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
