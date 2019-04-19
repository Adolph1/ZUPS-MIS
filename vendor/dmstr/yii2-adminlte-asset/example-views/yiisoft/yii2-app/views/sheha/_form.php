<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Sheha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sheha-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jina_kamili')->textInput(['maxlength' => true,'placeholder' => 'Ingiza jina kamili']) ?>
    <?= $form->field($model, 'tarehe_kuzaliwa')->widget(\kartik\date\DatePicker::ClassName(),
        [
            //'name' => 'purchase_date',
            //'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => ['placeholder' => 'Ingiza tarehe ya kuzaliwa'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'autoclose'=>true,
            ]
        ])?>

    <?= $form->field($model, 'mtaa')->textInput(['maxlength' => true,'placeholder' => 'Ingiza mtaa']) ?>

    <?= $form->field($model, 'nyumba_namba')->textInput(['maxlength' => true,'placeholder' => 'Ingiza namba ya nyumba']) ?>

    <?= $form->field($model, 'jinsia')->dropDownList(['M' => 'Mume','F'=>'Mke'],['prompt' => '--Chagua Jinsia--']) ?>

    <?= $form->field($model, 'simu')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza namba ya simu']) ?>

    <?= $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAll(),['prompt' => '--Chagua Wilaya--']) ?>


    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
