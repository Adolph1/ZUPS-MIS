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
<div class="mzee-index">

    <hr/>
    <div class="row">
        <div class="col-md-12">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA WAZEE WALIOCHUKULIWA FINGER PRINT KISHEHIA</strong>
        </div>


    </div>
    <hr/>
    <?php
    $mikoas = \backend\models\Mkoa::find()->select('id')->where(['zone_id' => \backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
    $wilayas = \backend\models\Wilaya::find()->select('id')->where(['in','mkoa_id',$mikoas]);
    $pdfHeader = [
        'L' => [
            'content' => 'ZUPS REPOTI',
        ],
        'C' => [
            'content' => 'IDADI YA WAZEE WALISAJILIWA FINGER PRINT NA ASILIMIA ZAO KIMKOA',
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

    <?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],

        [
            'attribute' => 'kituo_id',
            'value' => 'kituo.kituo',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Vituo::find()->where(['in','wilaya_id',$wilayas])->orderBy('id')->asArray()->all(), 'id', 'kituo'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa kituo'],
            'group' => true,
            'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
                return [
                    'mergeColumns'=>[[1,2]], // columns to merge in summary
                    'content'=>[             // content to show in each summary cell
                        1=>'JUMLA NDOGO ',
                        3=>GridView::F_SUM,
                        4=>GridView::F_SUM,
                        5=>GridView::F_SUM,
                        6=>GridView::F_SUM,
                    ],
                    'contentFormats'=>[      // content reformatting for each summary cell
                        3=>['format'=>'number', 'decimals'=>0],
                        4=>['format'=>'number', 'decimals'=>0],
                        5=>['format'=>'number', 'decimals'=>2],
                        6=>['format'=>'number', 'decimals'=>2],
                    ],
                    'contentOptions'=>[      // content html attributes for each summary cell
                        1=>['style'=>'font-variant:small-caps'],
                        3=>['style'=>'text-align:left'],
                        4=>['style'=>'text-align:left'],
                        5=>['style'=>'text-align:left'],
                        6=>['style'=>'text-align:left'],
                    ],
                    // html attributes for group summary row
                    'options'=>['class'=>'danger','style'=>'font-weight:bold;']
                ];
            },

        ],

        [
            'attribute' => 'shehia_id',
            'label' => 'Shehia',
            'value' => 'shehia.jina'

        ],


        [
            'attribute' => 'id',
            'label' => 'Idadi ya walengwa',
            'vAlign' => 'middle',
            'pageSummary'=>true,
           // 'width'=>'100px',
            'filter' => '',

            'value' => function ($model){
                return \backend\models\Mzee::getCountPerShehia($model->id);
            }
        ],
        [
            'attribute' => 'id',
            'label' => 'Wenye Finger print',
            'vAlign' => 'middle',
           // 'width'=>'100px',
            'filter' => '',
            'pageSummary'=>true,

            'value' => function ($model){
                return \backend\models\Mzee::getCountPerShehiaWithFinger($model->id);
            }
        ],
        [
            'attribute' => 'id',
            'label' => 'Finger print za wasaidizi',
            'vAlign' => 'middle',
           // 'width'=>'100px',
            'filter' => '',
            'pageSummary'=>true,

            'value' => function ($model){
                return \backend\models\Mzee::getCountPerShehiaMsaidiziFinger($model->id);
            }
        ],
          [
            'attribute' => 'id',
            'label' => 'Mzee / Msaidizi',
            'vAlign' => 'middle',
           // 'width'=>'100px',
            'filter' => '',
            'pageSummary'=>true,

            'value' => function ($model){
                return \backend\models\Mzee::getCountPerShehiaEitherFinger($model->id);
            }
        ],

        /*[
            'attribute' => 'id',
            'label' => 'Wasio na finger print',
            'vAlign' => 'middle',
            'width'=>'100px',
            'filter' => '',
            'pageSummary'=>true,

            'value' => function ($model){
                return \backend\models\Mzee::getCountPerShehiaNoFinger($model->id);
            }
        ],*/
        [
            'attribute' => 'id',
            'label' => 'Asilimia ya wenye finger print',
            'vAlign' => 'middle',
           // 'width'=>'100px',
            'filter' => '',
            'format' => ['decimal', 2],
            'pageSummary'=>true,

            'value' => function ($model){
                if(\backend\models\Mzee::getCountPerShehia($model->id)>0) {
                    return (100 * \backend\models\Mzee::getCountPerShehiaWithFinger($model->id) / (\backend\models\Mzee::getCountPerShehia($model->id)));
                }else{
                    return 0;
                }
            }
        ],
    ];





    echo GridView::widget([
        'dataProvider'=> $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'striped'=>true,
        'hover'=>true,
        'showPageSummary'=>true,
        'pjax'=>true,
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
           // 'beforeGrid'=>'My fancy content before.',
            //'afterGrid'=>'My fancy content after.',
        ],
         'panel' => [
        'type' => GridView::TYPE_INFO,
        'heading' => 'WITH FINGER PRINT',
            // 'before' => '<span class="text text-red"> *Eligible*</span>'
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
                'filename' => Yii::t('kvgrid', 'Zups - Repoti ya malipo kiwilaya'),
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
                'filename' => 'ZUPS - RIPOTI YA MWEZI',
                'options' => ['title' => 'Repoti ya mwezi'],
            ],
        ],

    ]);


    ?>
</div>
