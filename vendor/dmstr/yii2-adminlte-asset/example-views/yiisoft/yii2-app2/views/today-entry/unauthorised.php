<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TodayEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Today Entries';
?>

<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-folder"></i><strong> TODAY UNAUTHORISED TRANSACTIONS</strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-md-12">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'module',
            'trn_ref_no',
            'trn_dt',
             'ac_no',
             'amount',
            'drcr_ind',
            [
                'header'=>'Customer Name',
                'value'=>function($model){
                    return \backend\models\Customer::getFullNameByCustomerNumber($model->related_customer);
                }
            ],
            'branch.branch_name',
            'product',
            'value_dt',
            'period_code',
            'finacial_year',
            'maker_id',
            'maker_stamptime',
            'auth_stat',

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        if($model->module=='DE'){
                            $path='teller';
                            $id=\backend\models\Teller::getIDByReference($model->trn_ref_no);
                            $url=[$path.'/view','id' => $id];
                            return Html::a('<span class="fa fa-eye"></span>', $url, [
                                'title' => 'View',
                                'data-toggle'=>'tooltip','data-original-title'=>'Save',
                                'class'=>'btn btn-info',

                            ]);
                        }elseif($model->module=='LD'){
                            $path='contract-master';
                            $id=$model->trn_ref_no;
                            $url=[$path.'/view','id' => $id];
                            return Html::a('<span class="fa fa-eye"></span>', $url, [
                                'title' => 'View',
                                'data-toggle'=>'tooltip','data-original-title'=>'Save',
                                'class'=>'btn btn-info',

                            ]);
                        }elseif($model->module=='MD'){
                            $path='contribution';
                            $id=\backend\models\Contribution::getIDByReference($model->trn_ref_no);
                            $url=[$path.'/view','id' => $id];
                            return Html::a('<span class="fa fa-eye"></span>', $url, [
                                'title' => 'View',
                                'data-toggle'=>'tooltip','data-original-title'=>'Save',
                                'class'=>'btn btn-info',

                            ]);
                        }



                    },

                ]
            ],
        ],
    ]); ?>
    </div>

</div>
