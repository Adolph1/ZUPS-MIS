<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MzeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ripoti');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzee-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - RIPOTI INAYOONESHA MALIPO YA BIDHAA</strong>
        </div>
        <div class="col-md-2">

        </div>

    </div>
    <hr/>
    <?php
    $pdfHeader = [
        'L' => [
            'content' => 'ZUPS REPOTI',
        ],
        'C' => [
            'content' => 'MALIPO YA BIDHAA',
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'arial',
            'color' => '#333333'
        ],
        'R' => [
            'content' => 'Imepakuliwa:'. date('Y-m-d H:i:s'),
        ],
        'line' => true,
    ];

    $pdfFooter = [
        'L' => [
            'content' => '&copy; ZUPS',
            'font-size' => 10,
            'color' => '#333333',
            'font-family' => 'arial',
        ],
        'C' => [
            'content' => '',
        ],
        'R' => [
            //'content' => 'RIGHT CONTENT (FOOTER)',
            'font-size' => 10,
            'color' => '#333333',
            'font-family' => 'arial',
        ],
        'line' => true,
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'tarehe',
            [
                'attribute' => 'aina_ya_matumizi',
                'label' => 'Matumizi',
                'value' => 'aina.hitaji',
            ],
            [
                'attribute' =>'kumbukumbu_no',
                'pageSummary' => 'Jumla'
            ],
            'idadi',

            [
                'attribute' =>'kiasi',
                'pageSummary' => true,
                'format' => ['decimal',2],

                'value' => function ($model){
                    if($model->status == 'R'){
                        return  '-'.$model->kiasi;
                    }else{
                        return $model->kiasi;
                    }
                }
            ],

            [
                'attribute' => 'stakabadhi',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->stakabadhi != null) {
                        $basepath = Yii::$app->request->baseUrl . '/uploads/receipts/' . $model->stakabadhi;
                        //$path = str_replace($basepath, '', $model->attachment);
                        return Html::a('<i class="fa fa-file text-green"></i>', $basepath, array('target' => '_blank'));
                    }else{
                        return '';
                    }
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model){
                    if($model->status == 'R'){
                        return 'Reversal';
                    }elseif($model->status == 'O'){
                        return 'Ordered';
                    }
                    else{
                        return '';
                    }
                }
            ],


        ],
        'striped'=>true,
        'showPageSummary' => true,
        'hover'=>true,
        'toolbar' =>  [
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        'pjaxSettings'=>[
            'neverTimeout'=>true,


        ],
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => 'RIPOTI YA MALIPO YA BIDHAA',
            'before'=>'<span class="text text-primary">' .$this->render('_bidhaa', ['model' => $searchModel]).'</span>',
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        'exportConfig' => [
            GridView::PDF => [
                'label' => Yii::t('kvgrid', 'PDF'),
                //'icon' => $isFa ? 'file-pdf-o' : 'floppy-disk',
                'iconOptions' => ['class' => 'text-danger'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('kvgrid', 'Zups - Repoti ya malipo ya Bidhaa'),
                'alertMsg' => Yii::t('kvgrid', 'The PDF export file will be generated for download.'),
                'options' => ['title' => Yii::t('kvgrid', 'Portable Document Format')],
                'mime' => 'application/pdf',
                'config' => [
                    'mode' => 'c',
                    'format' => 'A4-L',
                    'destination' => 'D',
                    'marginTop' => 20,
                    'marginBottom' => 20,
                    'cssInline' => '.kv-wrap{padding:20px;}' .
                        '.kv-align-center{text-align:center;}' .
                        '.kv-align-left{text-align:left;}' .
                        '.kv-align-right{text-align:right;}' .
                        '.kv-align-top{vertical-align:top!important;}' .
                        '.kv-align-bottom{vertical-align:bottom!important;}' .
                        '.kv-align-middle{vertical-align:middle!important;}' .
                        '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',

                    'methods' => [
                        'SetHeader' => [
                            ['odd' => $pdfHeader, 'even' => $pdfHeader]
                        ],
                        'SetFooter' => [
                            ['odd' => $pdfFooter, 'even' => $pdfFooter]
                        ],
                    ],

                    'options' => [
                        'title' => 'PDF export generated',
                        'subject' => Yii::t('kvgrid', 'PDF export generated by kartik-v/yii2-grid extension'),
                        'keywords' => Yii::t('kvgrid', 'krajee, grid, export, yii2-grid, pdf')
                    ],
                    'contentBefore'=>'',
                    'contentAfter'=>''
                ]
            ],
            GridView::CSV => [
                'label' => 'CSV',
                'filename' => 'ZUPS - RIPOTI ZA ZUPS',
                'options' => ['title' => 'Repoti za Zups'],
            ],
        ],

    ]);
    ?>
</div>
