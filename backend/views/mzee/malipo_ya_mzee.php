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

            'kiasi',
            [
                'attribute' => 'voucher_id',
                'label' => 'Mwezi',
                'value' => 'voucher.mwezi'
            ],
            [
                'attribute' => 'voucher_id',
                'label' => 'Mwaka',
                'value' => 'voucher.mwaka'
            ],



            'tarehe_kulipwa',

            [
                'attribute' => 'status',
                'value' => function ($model){
                    if($model->status == \backend\models\Malipo::PENDING) {
                        return 'BADO';
                    }elseif ($model->status == \backend\models\Malipo::PAID){
                        return 'AMELIPWA';
                    }elseif ($model->status == \backend\models\Malipo::EXPIRED){
                        return 'MALIPO YAMEISHA MUDA WAKE';
                    }elseif ($model->status == \backend\models\Malipo::SUPPRESSED){
                        return 'MALIPO YAMESITISHWA';
                    }

                }
            ],
        ],
    ]); ?>
</div>
