<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\MatumiziMengine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matumizi-mengine-form">
    <div id="loader1" style="display: none"></div>
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
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
                'options'=>['placeholder'=>'Ingiza tarehe ya muamala','value' => date('Y-m-d')]
            ]);?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'kumbukumbu_no')->textInput(['readonly' => 'readonly']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'aina_ya_matumizi')->dropDownList(\backend\models\Mahitaji::getAllWithoutPosho(),['prompt' => '--Chagua aina--']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'budget_idadi')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'idadi')->textInput(['maxlength' => true,'oninput' => "myFunction()"]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'bei')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'kiasi')->textInput(['maxlength' => true,'readonly' => 'readonly']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'stakabadhi_ya_malipo')->fileInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'supplier_id')->dropDownList(\backend\models\Supplier::getAll(),['prompt' => '--Chagua Supplier--']) ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'malezo')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <p id="demo"></p>
    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function myFunction() {
        var x = document.getElementById("matumizimengine-idadi").value;
        var b = document.getElementById("matumizimengine-budget_idadi").value;
        var d = document.getElementById("matumizimengine-bei").value;

        if(b == null){
            alert('Tafadhari chagua kwanza aina ya matumizi');
            document.getElementById("matumizimengine-idadi").value = '';
        }else {
            var c = b-x;

            if( c < 0){
                alert('Idadi unayoweka haiwezi zidi ile ya budget');
                document.getElementById("matumizimengine-idadi").value = '';
                document.getElementById("matumizimengine-kiasi").value = '';
        }else{
                document.getElementById("matumizimengine-kiasi").value = x * d;

            }
        }


    }
</script>