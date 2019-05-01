<?php

use backend\models\MalipoSearch;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Voucher */

$this->title = $model->kumbukumbu_namba;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vouchers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-view">

<hr/>

    <div class="row">
        <div class="col-lg-3">
            <h4>Kumb. Namba: <?= Html::encode($this->title) ?></h4>
        </div>
        <div class="col-lg-2">
            <h4>Mwezi: <?= $model->mwezi?></h4>
        </div>
        <div class="col-lg-2">
            <h4>Mwaka: <?= $model->mwaka?></h4>
        </div>
        <div class="col-lg-3 text-right">
        <?= Html::a(Yii::t('app', 'Futa voucher hii'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Unataka kufuta hii voucher?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Voucher'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12">
            <legend class="lead text-primary">Orodha ya wazee wanatakiwa kulipwa kwa Voucher hii</legend>
        </div>
    </div>
    <?php
    $searchModel = new MalipoSearch();
    $dataProvider = $searchModel->searchByVoucherId($model->id);

    ?>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'mzee_id',
                'value' => function ($model){
                    return $model->mzee->majina_mwanzo. ' ' .$model->mzee->jina_babu;
                }
            ],
            'kiasi',
           // 'siku_kwanza',
           // 'siku_pili',
           // 'siku_mwisho',

            [
                'attribute' => 'shehia_id',
                'value' => function ($model){
                if($model->shehia_id != null) {
                    return $model->mzee->shehia->jina;
                }else{
                    return;
                }
                }
            ],
            [
                'attribute' => 'kituo_id',
                'label' => 'Kituo',
                'value' => function ($model){
                    if($model->kituo_id != null) {
                        return $model->mzee->kituo->kituo;
                    }else{
                        return ' ';
                    }
                }
            ],

            'tarehe_kulipwa',
            [
                'attribute' => 'cashier_id',
                'value' => 'cashier.jina_kamili'
            ],
            // 'device_number',
            // 'kituo_id',
            [
                'attribute' => 'status',
                'value' => function ($model){
                    if($model->status == \backend\models\Malipo::PENDING) {
                        return 'PENDING';
                    }elseif ($model->status == \backend\models\Malipo::PAID){
                        return 'PAID';
                    }elseif ($model->status == \backend\models\Malipo::EXPIRED){
                        return 'EXPIRED';
                    }

                }
            ],
            // 'aliyelipwa',
            // 'muda',

        ],
    ]); ?>

</div>
