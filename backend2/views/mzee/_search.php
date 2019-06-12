<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use kartik\field\FieldRange;

/* @var $this yii\web\View */
/* @var $model backend\models\MzeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mzee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['search-all'],
        'method' => 'get',
    ]); ?>
<div class="panel panel-warning"  style="background: #EEE">
    <div class="panel panel-heading">
        <a data-toggle="collapse" href="#collapse1"> Advance Search</a>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
    <div class="panel panel-body" style="background: #EEE">
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'jinsia')->dropDownList(['M' => 'MUME','F'=> 'MKE'],['prompt' => '--Chagua--']) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'umri_sasa') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'kazi_id')->dropDownList(\backend\models\KaziMzee::getAll(),['prompt' => '--Chagua kazi--']) ?>
    </div>
</div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'mzawa_zanzibar')->dropDownList(['Y' => 'NDIYO','N'=> 'HAPANA'],['prompt' => '--Chagua--']) ?>
        </div>
        <div class="col-md-4">

            <?= $form->field($model, 'aina_ya_kitambulisho')->dropDownList(\backend\models\AinaYaKitambulisho::getAll(),['prompt' => '--Chagua wilaya--']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'mkoa_id')->dropDownList(\backend\models\Mkoa::getAllByZoneID(\backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)),['prompt' => '--Chagua mkoa--']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAll(),['prompt' => '--Chagua wilaya--']) ?>
        </div>
        <div class="col-md-4">

           <?= $form->field($model, 'shehia_id')->widget(Select2::classname(), [
             'data' => backend\models\Shehia::getAll(),
            'language' => 'en',
            'options' => ['placeholder' => 'Chagua shehia ...',],
            'pluginOptions' => [
            'allowClear' => true
            ],
            ])?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'mtaa') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">

            <?= $form->field($model, 'pension_nyingine')->dropDownList(\backend\models\PensionNyingine::getAll(),['prompt' => '--Chagua pencheni--']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'anaishi')->dropDownList(['1' => 'NDIYO','0'=>'HAPANA'],['prompt' => '--Chagua--']) ?>
        </div>
    </div>


    <?= $form->field($model, 'status')->dropDownList(\backend\models\Mzee::getReportStatuses(),['prompt' => '--Chagua--']) ?>




    <div class="form-group" style="float: right">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
    </div>
</div>
</div>
