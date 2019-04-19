<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\MalipoMaafisa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="malipo-maafisa-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6">


        <?= $form->field($model, 'tarehe_ya_malipo')->widget(
            DatePicker::className(), [
            // inline too, not bad
            'inline' => false,
            // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',

            ],
            'options'=>['placeholder'=>'Ingiza tarehe ya muamala']
        ]);?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'kumbukumbu_no')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
    </div>
</div>

    <?php

    echo $form->field($model, 'kituo_id')->widget(Select2::classname(), [
        'data' => \backend\models\Vituo::getAll(),
        'language' => 'en',
        'options' => ['placeholder' => 'Chagua kituo ...','id' => 'kituo-id'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);


    ?>


    <?= $form->field($model, 'jina_kamili')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kazi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'namba_ya_simu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kiasi')->textInput() ?>




    <?= $form->field($model, 'ofisi_aliyotoka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kazi_anayoenda_kufanya')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
