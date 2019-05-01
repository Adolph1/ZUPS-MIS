<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Mzee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mzees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fomu_namba',
            'picha',
            'majina_mwanzo',
            'jina_babu',
            'jina_maarufu',
            'jinsia',
            'tarehe_kuzaliwa',
            'umri_kusajiliwa',
            'umri_sasa',
            'kazi_id',
            'mzawa_zanzibar',
            'aina_ya_kitambulisho',
            'nambar',
            'tarehe_kuingia_zanzibar',
            'simu',
            'mkoa_id',
            'wilaya_id',
            'shehia_id',
            'mtaa',
            'namba_nyumba',
            'anuani_kamili_mtaa',
            'anuani_ya_posta',
            'posho_wilaya',
            'njia_upokeaji',
            'jina_bank',
            'jina_account',
            'nambari_account',
            'simu_kupokelea',
            'wanaomtegemea',
            'pension_nyingine',
            'aina_ya_pension',
            'aliyeweka',
            'muda',
            'anaishi',
            'status',
            'tarehe_kufariki',
            'mtu_karibu',
            'jinsia_mtu_karibu',
            'tarehe_kuzaliwa_mtu_karibu',
            'umri_mtu_karibu',
            'namba_simu',
            'picha_mtu_karibu',
            'anuani_kamili_mtu_karibu',
            'aina_ya_kitambulisho_mtu_karibu',
            'nambari_ya_kitambulisho',
            'uhasiano',
            'mchukua_taarifa_id',
            'maoni_ofisi_wilaya',
            'mzee_finger_print:ntext',
            'mtu_karibu_finger_print:ntext',
        ],
    ]) ?>

</div>
