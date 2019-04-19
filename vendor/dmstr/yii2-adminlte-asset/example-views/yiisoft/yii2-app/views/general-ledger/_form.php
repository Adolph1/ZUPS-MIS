<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\GlCategory;
use backend\models\GlType;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\GeneralLedger */
/* @var $form yii\widgets\ActiveForm */

?>

<?php $form = ActiveForm::begin(); ?>
<?php
//Get all Gl Category
$glcate=GlCategory::find()->all();
$listData=ArrayHelper::map($glcate,'cate_id','category_name');
$form->field($model, 'category')->dropDownList(
    $listData,
    ['prompt'=>'Select...']);

//Get all Gl Types
$gltype=GlType::find()->all();
$listtype=ArrayHelper::map($gltype,'id','name');
$form->field($model, 'type')->dropDownList(
    $listtype,
    ['prompt'=>'Select...']);

//Get All GL Parents
$gls=\backend\models\GeneralLedger::find()->all();

$listgls=ArrayHelper::map($gls,'gl_code','gl_description');
$form->field($model, 'parent_gl')->dropDownList(
    $listgls,
    ['prompt'=>'Select...']);

?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('app', 'General Ledger Form'); ?>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-md-3">
                        <?= $form->field($model, 'gl_code')->textInput() ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'parent_gl')->dropDownList($listgls, ['prompt'=>'--Select--'])?>

                    </div>


                    <div class="col-md-3">
                        <?= $form->field($model, 'leaf')->radioList(array('1'=>'Leaf','2'=>'Node GL')); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'gl_description')->textInput(['maxlength' => 50]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'customer')->radioList(array('1'=>'Customer GL','2'=>'Internal GL')) ?>
                    </div>

                    </div>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'category')->dropDownList($listData, ['prompt'=>'--Select--'])?>

                        </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'type')->dropDownList($listtype, ['prompt'=>'--Select--'])?>

                        </div>

                    <div class="col-md-3">
                        <?= $form->field($model, 'posting_restriction')->radioList(array('1'=>'Direct Posting','2'=>'Indirect Posting')); ?>

                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

