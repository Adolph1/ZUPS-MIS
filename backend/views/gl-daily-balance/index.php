<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GlDailyBalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Gl Daily Balances');
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-bank"></i><strong> GL DAILY BALANCES</strong></h3>
    </div>

</div>
<hr>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',

            [
                'label'=>'GL Account',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'value'=>function($model){
                        return Html::a($model->gl_code, ['load-trn', 'gl' => $model->gl_code,'date'=>$model->trn_date]);
            },

            ],

            [
                'attribute'=>'opening_balance',
                'format' => ['decimal',2],
                'contentOptions' => ['class' => 'text-right'],
                'headerOptions' => ['class' => 'text-right']
            ],
            [
                'attribute'=>'dr_turn',
                'format' => ['decimal',2],
                'contentOptions' => ['class' => 'text-right'],
                'headerOptions' => ['class' => 'text-right']
            ],
            [
                'attribute'=>'cr_turn',
                'format' => ['decimal',2],
                'contentOptions' => ['class' => 'text-right'],
                'headerOptions' => ['class' => 'text-right']
            ],
            [
                'attribute'=>'closing_balance',
                'format' => ['decimal',2],
                'contentOptions' => ['class' => 'text-right'],
                'headerOptions' => ['class' => 'text-right']
            ],
            'trn_date',

            //['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
           'clientOptions' => [
               "lengthMenu"=> [[100,-1], [100,Yii::t('app',"All")]],
               "info"=>true,
               "responsive"=>true,
               "dom"=> 'lfTrtip',
               "tableTools"=>[
                   "aButtons"=> [
                       /*[
                           "sExtends"=> "copy",
                           "sButtonText"=> Yii::t('app',"Copy to clipboard")
                       ],[
                           "sExtends"=> "csv",
                           "sButtonText"=> Yii::t('app',"Save to CSV")
                       ],*/
                       [
                           "sExtends"=> "xls",
                           "oSelectorOpts"=> ["page"=> 'current']
                       ],[
                           "sExtends"=> "pdf",
                           "sButtonText"=> Yii::t('app',"Save to PDF")
                       ],[
                           "sExtends"=> "print",
                           "sButtonText"=> Yii::t('app',"Print")
                       ],
                   ]
               ]
           ],
    ]); ?>
    </div>
</div>
