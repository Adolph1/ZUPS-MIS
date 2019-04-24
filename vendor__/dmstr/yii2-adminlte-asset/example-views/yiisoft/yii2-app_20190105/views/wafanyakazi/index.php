<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WafanyakaziSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wafanyakazis');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wafanyakazi-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-users"></i> ZUPS - WAFANYAKAZI</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-user"></i> Mfanyakazi Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Wafanyakazi'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'jina_kamili',
            [
                    'attribute' => 'department_id',
                    'value' => 'department.jina'
            ],
            [
                'attribute' => 'mkoa_id',
                'value' => 'mkoa.jina'
            ],
            [
                'attribute' => 'wilaya_id',
                'value' => 'wilaya.jina'
            ],
            [
                'attribute' => 'report_to',
                'value' => function ($model){
                    if($model->report_to == null){
                        return ' ';
                    }else{
                        return $model->report_to;
                    }
                }
            ],
            'status',
            // 'aliyeweka',
            // 'muda',

            ['class' => 'yii\grid\ActionColumn','header' => 'Actions'],
        ],
        'clientOptions' => [
            "lengthMenu"=> [[50,-1], [50,Yii::t('app',"All")]],
            "info"=>false,
            "responsive"=>true,
            "dom"=> 'lfTrtip',
            "tableTools"=>[
                "aButtons"=> [
                    [
                        "sExtends"=> "copy",
                        "sButtonText"=> Yii::t('app',"Copy to clipboard")
                    ],[
                        "sExtends"=> "csv",
                        "sButtonText"=> Yii::t('app',"Save to CSV")
                    ],[
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
