<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MatumiziMengineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Matumizi Mengine';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matumizi-mengine-index">


    <hr/>
    <div class="row">
        <div class="col-md-8">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - BIDHAA ZILIZOLIPIWA NA ZINASUBIRIWA KUINGIA</strong>
        </div>

    </div>
    <hr/>
    <?php
    $pdfHeader = [
        'L' => [
            'content' => 'ZUPS REPOTI',
        ],
        'C' => [
            'content' => 'BIDHAA ZINAZOSUBIRIWA KUINGIA',
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


            [
                'attribute' => 'aina_ya_matumizi',
                'label' => 'Matumizi',
                'value' => 'aina.hitaji',
            ],
            [
                    'attribute' =>'tarehe',
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
                'class'=>'kartik\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['bidhaa-zilizoingia/create','id' => $model->id];
                        return Html::a('<span class="fa fa-check"></span>', $url, [
                            'title' => 'Thibitisha kupokea',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',


                        ]);


                    },

                ]
            ],
        ],
        'striped'=>true,
        'showPageSummary' => true,
        'hover'=>true,
        'toolbar' =>  [
            ['content' =>
            // Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
            ],
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
            'heading' => 'ORODHA YA BIDHAA',
            //'before'=>'<span class="text text-primary">Hii ripoti inaonesha jinsi malipo yalivofanyika kwa mwezi huu wa : '.date('m').'</span>',
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
                'filename' => Yii::t('kvgrid', 'Zups - BIDHAA ZILIZOLIPIWA NA ZINASUBIRIWA KUINGIA'),
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
                'filename' => 'ZUPS - BIDHAA ZILIZOLIPIWA NA ZINASUBIRIWA KUINGIA',
                'options' => ['title' => 'Repoti ya mwezi'],
            ],
        ],

    ]);
    ?>
</div>
