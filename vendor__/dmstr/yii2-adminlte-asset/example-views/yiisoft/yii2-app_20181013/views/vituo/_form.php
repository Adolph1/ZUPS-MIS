<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Vituo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vituo-form">
    <div id="loader1" style="display: none"></div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kituo')->textInput(['maxlength' => true]) ?>
    <?=   $form->field($model, 'wilaya_id')->widget(Select2::classname(), [
            'data' => \backend\models\Wilaya::getAll(),
            'language' => 'en',
            'options' => ['placeholder' => 'chagua wilaya ...','id' => 'wilaya-cashier-id'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => false
            ],
        ]);
    ?>

    <?= $model->isNewRecord ?
        $form->field($model, 'shehias')->widget(Select2::classname(), [
           // 'data' => \backend\models\Shehia::getAll(),
            'language' => 'en',
            'options' => ['placeholder' => 'chagua shehia ...','id'=>'kituo-shehia-id'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true
            ],
        ]) :
        $form->field($model, 'shehias')->widget(Select2::classname(), [

            'data' => \backend\models\Shehia::getAll(),
            'maintainOrder' => true,
            'language' => 'en',
            'options' => ['placeholder' => 'chagua shehia ...','id'=>'kituo-shehia-id'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true
            ],
        ])
    ;
    ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
