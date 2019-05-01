<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MalipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$searchModel = new \backend\models\MalipoSearch();
$dataProvider = $searchModel->searchByMzeeId($model->id);
?>
<div class="malipo-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'voucher_id',
                'value' => 'voucher.kumbukumbu_namba'
            ],
            'siku_kwanza',
           // 'siku_pili',
           // 'siku_mwisho',
            [
                'attribute' => 'shehia_id',
                'value' => function ($model){
                    return $model->mzee->shehia->jina;
                }
            ],

            'kiasi',
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
        ],
    ]); ?>
</div>
