<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AutomationSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="automation-settings-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'zone_id')->dropDownList(\backend\models\Zone::getAll(),['prompt' => '--Chagua--']) ?>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <?= $form->field($model, 'malipo_kwanza')->textInput(['placeholder' => 'Ingiza siku ya kwanza ya malipo']) ?>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <?= $form->field($model, 'malipo_ya_mwisho')->textInput(['placeholder' => 'Ingiza siku ya mwisho ya malipo']) ?>
    </div>
</div>


    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <?= $form->field($model, 'mwisho_kuaandaa_voucher')->textInput(['placeholder' => 'Ingiza siku ya mwisho ya kuandaa voucher']) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <?= $form->field($model, 'muda_wa_voucher')->textInput(['placeholder' => 'Ingiza muda wa voucher kutumika kwa malipo']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'idadi_ya_kuchukulia')->textInput(['placeholder' => 'Ingiza idadi ya wazee wanaoweza chukuliwa fedha na mtu wa karibu mmoja']) ?>
        </div>

    </div>


    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
