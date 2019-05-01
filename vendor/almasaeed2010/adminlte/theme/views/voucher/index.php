<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VoucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vouchers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-index">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA VOUCHER</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">



            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Voucher'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'tarehe_kuandaliwa',
            'kumbukumbu_namba',
            'mwezi',
             'mwaka',
             'eligible',
            'jumla_fedha',
            // 'jumla_iliyolipwa',
            // 'jumla_iliyobaki',
           [
                   'attribute' => 'status',
                    'value' => function ($model){
                    if($model->status == 1){
                        return 'Generated';
                    }else{
                        return 'CLOSED';
                    }
                    }
           ],
            // 'aliyeandaa',
            // 'muda',

           /* [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Print Preview',
                'template'=>'{clone}',
                'buttons'=>[
                    'clone' => function ($url, $model) {
                        $url=['print-preview','id' => $model->id];
                        return Html::a('<span class="fa fa-print"></span>', $url, [
                            'title' => 'Print Preview',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-default',

                        ]);


                    },

                ]
            ],*/
            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'View',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-arrow-right"></span>', $url, [
                            'title' => 'angalia malipo ya wazee',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },


                ]
            ],
        ],
    ]); ?>
</div>
