<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TellerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transactions');
?>
<div class="row">
    <div class="col-md-6">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file-o"></i><strong> ZUPS - ORODHA YA MIAMALA</strong></h3>
    </div>
    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 text-right">

        <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> Muamala Mpya'), ['create'], ['class' =>yii::$app->User->can('FT-input') ? 'btn btn-default text-green enabled':'btn btn-default text-green disabled']) ?>


        <?= Html::a(Yii::t('app', '<i class="fa fa-th text-black"></i> Orodha ya Miamala'), ['index'], ['class' => 'btn btn-default text-green']) ?>


    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'reference',
            'trn_dt',

            'amount',
           [
                   'attribute' => 'trn_type',
                    'value' => function($model){
                        if($model->trn_type == \backend\models\Teller::ALLOWANCE){
                            return 'ALLOWANCE';
                        }elseif($model->trn_type == \backend\models\Teller::PENSION){
                            return 'PENSION';
                        }
                    }
           ],
            'status',
            'month',
            'year',
            [
                'attribute' => 'pay_point_id',
                'value' => 'payPoint.kituo'
            ],
            [
                'attribute' => 'related_customer',
                'label' => 'Karani',
                'value' => 'cashier.jina_kamili'
            ],


            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-eye"></span>', $url, [
                            'title' => 'View',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },

                ]
            ],
        ],
    ]); ?>
    </div>
</div>
