<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Sheha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sheha-form">
    <div id="loader1" style="display: none"></div>
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
    <?= $form->field($model, 'aina')->dropDownList(['1' => 'Sheha','2'=>'Msaidizi wa sheha'],['prompt' => '--Chagua Aina ya sheha--']) ?>

    <?= $form->field($model, 'simu')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza namba ya simu']) ?>
    <?php
    if(Yii::$app->user->can('DataClerk')) {
        ?>
        <?= $model->isNewRecord ? $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getDistrictBYUSerID(Yii::$app->user->identity->user_id), ['readonly' => 'readonly']) : $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getDistrictBYID($model->wilaya_id), ['readonly' => 'readonly']) ?>

        <?php
    }else {
        ?>
        <?= $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAll(), ['prompt' => '--Chagua Wilaya--']) ?>
        <?php
    }
    ?>
    <?= $form->field($model, 'shehia_id')->dropDownList(\backend\models\Shehia::getAll(),['prompt' => '--Chagua Shehia--']) ?>
    <?php
    if(!$model->isNewRecord) {

        ?>
        <?= $form->field($model, 'status')->dropDownList([\backend\models\Sheha::ACTIVE => 'Active', \backend\models\Sheha::DISABLED => 'Disable'], ['prompt' => '--Chagua status--']) ?>
        <?php
    }
    ?>


    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
