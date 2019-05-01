<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MzeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mzee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fomu_namba') ?>

    <?= $form->field($model, 'picha') ?>

    <?= $form->field($model, 'majina_mwanzo') ?>

    <?= $form->field($model, 'jina_babu') ?>

    <?php // echo $form->field($model, 'jina_maarufu') ?>

    <?php // echo $form->field($model, 'jinsia') ?>

    <?php // echo $form->field($model, 'tarehe_kuzaliwa') ?>

    <?php // echo $form->field($model, 'umri_kusajiliwa') ?>

    <?php // echo $form->field($model, 'umri_sasa') ?>

    <?php // echo $form->field($model, 'kazi_id') ?>

    <?php // echo $form->field($model, 'mzawa_zanzibar') ?>

    <?php // echo $form->field($model, 'aina_ya_kitambulisho') ?>

    <?php // echo $form->field($model, 'nambar') ?>

    <?php // echo $form->field($model, 'tarehe_kuingia_zanzibar') ?>

    <?php // echo $form->field($model, 'simu') ?>

    <?php // echo $form->field($model, 'mkoa_id') ?>

    <?php // echo $form->field($model, 'wilaya_id') ?>

    <?php // echo $form->field($model, 'shehia_id') ?>

    <?php // echo $form->field($model, 'mtaa') ?>

    <?php // echo $form->field($model, 'namba_nyumba') ?>

    <?php // echo $form->field($model, 'anuani_kamili_mtaa') ?>

    <?php // echo $form->field($model, 'anuani_ya_posta') ?>

    <?php // echo $form->field($model, 'posho_wilaya') ?>

    <?php // echo $form->field($model, 'njia_upokeaji') ?>

    <?php // echo $form->field($model, 'jina_bank') ?>

    <?php // echo $form->field($model, 'jina_account') ?>

    <?php // echo $form->field($model, 'nambari_account') ?>

    <?php // echo $form->field($model, 'simu_kupokelea') ?>

    <?php // echo $form->field($model, 'wanaomtegemea') ?>

    <?php // echo $form->field($model, 'pension_nyingine') ?>

    <?php // echo $form->field($model, 'aina_ya_pension') ?>

    <?php // echo $form->field($model, 'aliyeweka') ?>

    <?php // echo $form->field($model, 'muda') ?>

    <?php // echo $form->field($model, 'anaishi') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'tarehe_kufariki') ?>

    <?php // echo $form->field($model, 'mtu_karibu') ?>

    <?php // echo $form->field($model, 'jinsia_mtu_karibu') ?>

    <?php // echo $form->field($model, 'tarehe_kuzaliwa_mtu_karibu') ?>

    <?php // echo $form->field($model, 'umri_mtu_karibu') ?>

    <?php // echo $form->field($model, 'namba_simu') ?>

    <?php // echo $form->field($model, 'picha_mtu_karibu') ?>

    <?php // echo $form->field($model, 'anuani_kamili_mtu_karibu') ?>

    <?php // echo $form->field($model, 'aina_ya_kitambulisho_mtu_karibu') ?>

    <?php // echo $form->field($model, 'nambari_ya_kitambulisho') ?>

    <?php // echo $form->field($model, 'uhasiano') ?>

    <?php // echo $form->field($model, 'mchukua_taarifa_id') ?>

    <?php // echo $form->field($model, 'maoni_ofisi_wilaya') ?>

    <?php // echo $form->field($model, 'mzee_finger_print') ?>

    <?php // echo $form->field($model, 'mtu_karibu_finger_print') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
