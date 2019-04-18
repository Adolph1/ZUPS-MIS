<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\ClerkKituo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clerk-kituo-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'date_assigned')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',

        ],
        'options'=>['placeholder'=>'Ingiza tarehe']
    ]);?>

    <?=   $form->field($model, 'kituo_id')->widget(Select2::classname(), [
        'data' => \backend\models\Vituo::getAll(),
        'language' => 'en',
        'options' => ['placeholder' => 'chagua kituo ...',],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => false
        ],
    ]);
    ?>
    <?=   $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => \backend\models\Wafanyakazi::getAll(Yii::$app->user->identity->user_id),
        'language' => 'en',
        'options' => ['placeholder' => 'chagua clerk ...',],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => false
        ],
    ]);
    ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
