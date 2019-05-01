<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MzeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mzees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzee-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA WAZEE</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-user"></i> Mzee Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Wazee'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'fomu_namba',
           // 'picha',
            'majina_mwanzo',
            'jina_babu',
            // 'jina_maarufu',
            // 'jinsia',
            //'tarehe_kuzaliwa',
            // 'umri_kusajiliwa',
             'umri_sasa',
            // 'kazi_id',
            // 'mzawa_zanzibar',
            // 'aina_ya_kitambulisho',
            // 'nambar',
            // 'tarehe_kuingia_zanzibar',
            // 'simu',
            // 'mkoa_id',
            // 'wilaya_id',
            // 'shehia_id',
            // 'mtaa',
            // 'namba_nyumba',
            // 'anuani_kamili_mtaa',
            // 'anuani_ya_posta',
            // 'posho_wilaya',
            // 'njia_upokeaji',
            // 'jina_bank',
            // 'jina_account',
            // 'nambari_account',
            // 'simu_kupokelea',
            // 'wanaomtegemea',
            // 'pension_nyingine',
            // 'aina_ya_pension',
            // 'aliyeweka',
            // 'muda',
            // 'anaishi',
            // 'status',
            // 'tarehe_kufariki',
            // 'mtu_karibu',
            // 'jinsia_mtu_karibu',
            // 'tarehe_kuzaliwa_mtu_karibu',
            // 'umri_mtu_karibu',
            // 'namba_simu',
            // 'picha_mtu_karibu',
            // 'anuani_kamili_mtu_karibu',
            // 'aina_ya_kitambulisho_mtu_karibu',
            // 'nambari_ya_kitambulisho',
            // 'uhasiano',
            // 'mchukua_taarifa_id',
            // 'maoni_ofisi_wilaya',
            // 'mzee_finger_print:ntext',
            // 'mtu_karibu_finger_print:ntext',

            ['class' => 'yii\grid\ActionColumn','header' => 'Actions'],
        ],
    ]); ?>
</div>
