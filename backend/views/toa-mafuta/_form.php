<?php

use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ToaMafuta */
/* @var $form yii\widgets\ActiveForm */
?>
<div id="loader1" style="display: none"></div>
<div class="toa-mafuta-form">

    <div class="panel panel-primary">
        <div class="panel panel-heading">
            <h4>Toa mafuta</h4>

        </div>
        <div class="panel panel-body">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"  style="float: right">

                    <?php

                    Modal::begin([
                        'header' => '<h2 class="lead">Taarifa za gari</h2>',
                        'toggleButton' => ['label' => '<i class="fa fa-truck"></i> Kodi gari', 'class' => 'lead btn btn-success'],
                        'size' => Modal::SIZE_DEFAULT,
                        'options' => ['class' => 'slide'],
                    ]);
                    ?>

                    <?php $form = ActiveForm::begin(['action' => ['vehicle-management/kodi-gari']]); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($gar, 'tarehe_ya_kukodi')->widget(
                                DatePicker::className(), [
                                // inline too, not bad
                                'inline' => false,
                                // modify template for custom rendering
                                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd',

                                ],
                                'options' => ['placeholder' => 'Ingiza tarehe ya kukodi', 'value' => date('Y-m-d')],
                            ]);

                            ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($gar, 'aina_ya_gari')->textInput(['maxlength' => true,'placeholder' => 'Ingiza aina ya gari']) ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($gar, 'plate_number')->textInput(['maxlength' => true,'placeholder' => 'Ingiza plate number']) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($gar, 'mmiliki_wa_gari')->textInput(['maxlength' => true,'placeholder'=>'Ingiza jina la mmiliki wa gari']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($gar, 'namba_ya_simu_mmiliki')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza namba ya simu ya mmliki wa gari']) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($gar, 'jina_la_dereva')->textInput(['maxlength' => true, 'placeholder'=>'Ingiza jina la dereva']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($gar, 'namba_ya_simu_dereva')->textInput(['maxlength' => true,'placeholder'=>'Ingiza namba ya simu ya dereva']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($gar, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAll(),['prompt' => '--Chagua wilaya--']) ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <?= Html::submitButton($gar->isNewRecord ? 'Create' : 'Update', ['class' => $gar->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>


                    <?php ActiveForm::end(); ?>


                    <?php

                    Modal::end();
                    ?>

                </div>
            </div>

    <?php $form = ActiveForm::begin(); ?>


            <?= $form->field($model, 'tarehe')->widget(
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

    <?= $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAll(),['prompt' => '--Chagua--']) ?>

    <?= $form->field($model, 'bidhaa_id')->dropDownList(['prompt' => '--Chagua--']) ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'budget_qty')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'kiasi')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'gari')->dropDownList(\backend\models\VehicleManagement::getAll(),['prompt' => '--Chagua gari--'])->label(false) ?>
    </div>

</div>




    <?= $form->field($model, 'vocha')->fileInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
