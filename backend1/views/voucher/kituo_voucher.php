<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VituoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vituo');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vituo-index">
    <hr/>
    <div class="row">
        <div class="col-md-10">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA VOUCHERS KWA KILA KITUO KATIKA BUDGET HII</strong>
        </div>
        <div class="col-md-2">

        </div>
    </div>
    <hr/>
    <?php
    $mikoa = \backend\models\Mkoa::find()->select('id')->where(['zone_id' => \backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
    $wilaya = \backend\models\Wilaya::find()->select('id')->where(['in','mkoa_id',$mikoa]);
    $vituo = \backend\models\Vituo::find()->select('id')->where(['in','wilaya_id',$wilaya]);
    ?>

    <?php
    $pdfHeader = [
        'L' => [
            'content' => 'ZUPS REPOTI',
        ],
        'C' => [
            'content' => ' ORODHA YA VOUCHERS KWA KILA KITUO KWA MWEZI '.date('m'),
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
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'kituo',
                'vAlign' => 'middle',
                'pageSummary' => 'Jumla',
                'width' => '400px',
                'group'=>true,  // enable grouping
                'subGroupOf'=>1, // supplier column index is the paren


            ],
            [
                'attribute' => 'wilaya_id',
                'value' => 'wilaya.jina',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\backend\models\Wilaya::find()->where(['in','id',$wilaya])->orderBy('id')->asArray()->all(), 'id', 'kituo'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    //'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Tafuta kwa wilaya'],
               // 'group' => true,
               /* 'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
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
                },*/

            ],


            [
                    'label' => 'Idadi ya shehia',
                    'attribute' => 'id',
                    'pageSummary' => true,
                    'value' => function ($model){
                        return \backend\models\KituoShehia::getSheiaCount($model->id);
                    }
            ],
            [
                'label' => 'Idadi ya Wazee watakaolipwa',
                'attribute' => 'id',
                'pageSummary' => true,
                'value' => function ($model){
                    return \backend\models\Malipo::getToBePaid($model->id);
                }
            ],
            [
                'class'=>'kartik\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['voucher/print-preview','id' => $model->id];
                        return Html::a('<span class="fa fa-print"></span>', $url, [
                            'title' => 'Fungua',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-default',

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
            'heading' => ' ORODHA YA VOUCHERS KWA KILA KITUO KWA MWEZI',
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
