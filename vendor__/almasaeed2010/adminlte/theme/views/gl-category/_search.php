<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GlCategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gl-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cate_id') ?>

    <?= $form->field($model, 'category_description') ?>

    <?= $form->field($model, 'category_name') ?>

    <?= $form->field($model, 'maker_id') ?>

    <?= $form->field($model, 'maker_stamptime') ?>

    <?php // echo $form->field($model, 'checker_id') ?>

    <?php // echo $form->field($model, 'checker_stamptime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
