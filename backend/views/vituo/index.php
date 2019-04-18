<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VituoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vituo');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vituo-index">
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA VITUO</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Kituo Kipya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Vituo'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'kituo',
            [
                    'label' => 'Idadi ya shehia',
                    'value' => function ($model){
                        return \backend\models\KituoShehia::getSheiaCount($model->id);
                    }
            ],
            [
                'label' => 'Idadi ya Wazee',
                'value' => function ($model){
                    return \backend\models\Mzee::getWazeeByKituoCount($model->id);
                }
            ],
            [
                'label' => 'Wilaya',
                'value' => 'wilaya.jina'
            ],

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
        'clientOptions' => [
            "lengthMenu"=> [[100,-1], [100,Yii::t('app',"All")]],
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
