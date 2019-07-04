<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MzeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wazee');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="mzee-index">

        <hr/>
        <div class="row">
            <div class="col-md-10">
                <strong class="lead" style="color: #01214d;font-family: Tahoma"> <i
                            class="fa fa-check-square text-green"></i> ZUPS - IDADI YA WAZEE KWA UJUMLA KWA KILA SHEHIA</strong>
            </div>

        </div>
        <hr/>
        <?php
        /*
            $gridColumns = [
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'contentOptions' => ['class' => 'kartik-sheet-style'],
                    'width' => '36px',
                    'headerOptions' => ['class' => 'kartik-sheet-style']
                ],

                [
                    'attribute' => 'mkoa_id',
                    'value' => 'mkoa.jina'
                ],
                [
                    'attribute' => 'wilaya_id',
                    'value' =>'wilaya.jina'
                ],
                [
                    'attribute' => 'shehia_id',
                    'value' =>'shehia.jina'
                ],
                [
                    'label' => 'Idadi ya Wazee',
                    'attribute' => 'shehia_id',
                    'pageSummary' => true,
                    'value' => function ($model){
                        return \backend\models\Mzee::getWazeeInSheiaCount($model->shehia_id);
                    }
                ],


            ];

            // the GridView widget (you must use kartik\grid\GridView)
            echo \kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                // 'filterSelector' => 'select[name="per-page"]',
                'columns' => $gridColumns,
                'id' => 'grid',
                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                'beforeHeader' => [
                    [
                        'options' => ['class' => 'skip-export'] // remove this row from export
                    ]
                ],


                'pjax' => true,
                'bordered' => true,
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'hover' => true,

                'floatHeaderOptions' => ['scrollingTop' => true],
                'showPageSummary' => true,
                'summary' => '',
                'panel' => [
                    'type' => GridView::TYPE_SUCCESS,
                    'heading' => '<h5><i class="fa fa-bar-chart" style="padding-left: 40%"></i>Idadi ya wazee wote kwa kila shehia</h5>',
                ],
                'rowOptions' => function ($model) {
                    return ['data-id' => $model->id];
                },
                'exportConfig' => [
                    GridView::EXCEL => [
                        'filename' => Yii::t('app', 'Request Reports'),
                        'showPageSummary' => true,
                        'options' => [
                            'title' => 'Custom Title',
                            'subject' => 'PDF export',
                            'keywords' => 'pdf'
                        ],

                    ],
                    GridView::PDF => [
                        'filename' => Yii::t('app', 'Request Reports'),
                        'showPageSummary' => true,
                        'options' => ['title' => Yii::t('app', 'Comma Separated Values')],

                    ],
                    GridView::JSON => [
                        'filename' => Yii::t('app', 'Request Reports'),
                        'showPageSummary' => true,
                        'options' => ['title' => Yii::t('app', 'Comma Separated Values')],

                    ],

                ],


                'pjaxSettings' => [
                    'neverTimeout' => true,
                    // 'beforeGrid'=>'My fancy content before.',
                    //'afterGrid'=>'My fancy content after.',
                ],
                'persistResize' => false,
                'toggleDataOptions' => ['minCount' => 10],
                // 'exportConfig' => $gridColumns

            ]);*/
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'showPageSummary' => true,
            'pjax' => true,
            'striped' => true,
            'hover' => true,
            'panel' => [
                'type' => GridView::TYPE_SUCCESS,
                'heading' => '<h5><i class="fa fa-bar-chart" style="padding-left: 40%"></i>Idadi ya wazee wote kwa kila shehia</h5>',
            ],
            'toggleDataContainer' => ['class' => 'btn-group mr-2'],
            'exportConfig' => [
                GridView::EXCEL => [
                    'filename' => Yii::t('app', 'Idadi ya Wazee'),
                    'showPageSummary' => true,
                    'options' => [
                        'title' => 'Custom Title',
                        'subject' => 'PDF export',
                        'keywords' => 'pdf'
                    ],

                ],

            ],
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' => 'mkoa_id',
                    'width' => '310px',
                    'value' => 'mkoa.jina',
                    'group' => true,  // enable grouping
                ],
                [
                    'label' => 'Idadi kwa Mkoa',
                    'attribute' => 'mkoa_id',
                    'group' => true,
                    'value' => function ($model) {
                        return \backend\models\Mzee::getWazeeInMkoaCount($model->mkoa_id);
                    }
                ],
                [
                    'attribute' => 'wilaya_id',
                    'value' => 'wilaya.jina',
                    'group' => true,
                ],
                [
                    'label' => 'Idadi Kiwilaya',
                    'attribute' => 'wilaya_id',
                    'group' => true,
                    'value' => function ($model) {
                        return \backend\models\Mzee::getWazeeInWilayaCount($model->wilaya_id);
                    }
                ],
                [
                    'attribute' => 'shehia_id',
                    'value' => 'shehia.jina',
                    'pageSummaryFunc' => GridView::F_AVG
                ],
                [
                    'label' => 'Idadi Kwa Shehia',
                    'attribute' => 'shehia_id',
                    'pageSummary' => true,
                    'value' => function ($model) {
                        return \backend\models\Mzee::getWazeeInSheiaCount($model->shehia_id);
                    }
                ],
            ],
        ]);

        ?>
    </div>
</div>