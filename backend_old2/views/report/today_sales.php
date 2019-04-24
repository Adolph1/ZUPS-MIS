<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;
use backend\models\SalesSearch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Today\'s sales summary report');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $searchModel = new SalesSearch();
    $dataProvider = $searchModel->searchTodaySales();
    ?>
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'trn_dt',
            'total_qty',
            'total_amount',
            'paid_amount',
            [
                'attribute'=>'payment_method',
                'value'=>'payMethod.method_name',
            ],
            'due_amount',
            // 'source_ref_number',
            // 'notes',
            'customer_name',
            // 'maker_id',
            // 'maker_time',
            'status',

            //['class' => 'yii\grid\ActionColumn','header'=>Yii::t('app',"Actions")],
        ],
        'clientOptions' => [
            "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
            "info"=>false,
            "responsive"=>true,
            "dom"=> 'lfTrtip',
            "tableTools"=>[
                "aButtons"=> [
                   [
                        "sExtends"=> "xls",
                        "oSelectorOpts"=> ["page"=> 'current']
                    ],
                    [
                        "sExtends"=> "pdf",
                        "sButtonText"=> Yii::t('app',"Save to PDF")
                    ],
                    [
                        "sExtends"=> "print",
                        "sButtonText"=> Yii::t('app',"Print")
                    ],
                ]
            ]
        ],

    ]);?>
</div>
