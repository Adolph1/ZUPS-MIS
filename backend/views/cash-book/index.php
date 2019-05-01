<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cash Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-book-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA MIAMALA</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Muamala Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Miamala'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'reference_no',
            'trn_dt',
            [
                    'attribute' => 'gl_account',
                    'pageSummary' => 'Jumla',
            ],

            [
                    'attribute' => 'dr_cr',
                    'label' => 'IN',
                    'pageSummary' => true,
                    'format' => ['decimal',2],
                    'value' => function ($model){
                        if($model->dr_cr == 'C'){
                            return $model->amount;
                        }else{
                            return '';
                        }
                    }
            ],
            [
                'attribute' => 'dr_cr',
                'label' => 'OUT',
                'pageSummary' => true,
                'format' => ['decimal',2],
                'value' => function ($model){
                    if($model->dr_cr == 'D'){
                        return $model->amount;
                    }else{
                        return '';
                    }
                }
            ],

            [
                'attribute' => 'dr_cr',
                'label' => 'Balance',
                'pageSummary' => true,
                'format' => ['decimal',2],
                'value' => function ($model,$credit,$debit){
                    if($model->dr_cr == 'C'){
                        $debit = $model->amount;
                        return $debit-0;
                    }elseif ($model->dr_cr == 'D'){

                        $credit = $model->amount;
                        return 0 - $credit;
                    }else
                    {
                        return '';
                    }

                }
            ],
           // 'dr_cr',
            'description',
            // 'auth_stat',
            // 'delete_stat',
            // 'maker_id',
            // 'maker_time',

            [
                'class'=>'kartik\grid\ActionColumn',
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
        'showPageSummary' => true,
    ]); ?>
</div>
