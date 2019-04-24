<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MzeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ripoti ya wazee');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzee-index">

    <?= $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $pdfHeader = [
        'L' => [
            'content' => 'ZUPS REPOTI',
        ],
        'C' => [
            'content' => 'MALIPO YA WAZEE KIWILAYA KWA MWEZI WA '.date('m'),
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

            //'fomu_namba',
           // 'majina_mwanzo',
        [
            'attribute' => 'majina_mwanzo',
            'label' => 'Mzee',
            'vAlign' => 'middle',
            'width' => '200px',

           // 'filterType' => GridView::FILTER_SELECT2,
           // 'filter' => ArrayHelper::map(\backend\models\Mzee::find()->orderBy('majina_mwanzo')->asArray()->all(), 'majina_mwanzo', 'majina_mwanzo'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
               // 'options' => ['multiple' => true]
            ],
            //'filterInputOptions' => ['placeholder' => 'Tafuta kwa majina ya mwanzo'],
            'format' => 'raw',
               'value' => function ($model){
                return $model->majina_mwanzo .' '. $model->jina_babu;

            }
        ],
        [
            'attribute' => 'msaidizi_id',
            'label' => 'Msaidizi',
            'value' => function ($model){
                if($model->msaidizi_id != null){
                    return \backend\models\MsaidiziMzee::getFullName($model->msaidizi_id);
                }else{
                    return '';
                }
            }
        ],
        [
            'attribute' => 'shehia_id',
            'vAlign' => 'middle',
            'width' => '50px',

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Shehia::find()->orderBy('jina')->asArray()->all(), 'id', 'jina'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa shehia'],
            'value' => function ($model){
                return $model->shehia->jina;
            }
        ],
        [
            'attribute' => 'wilaya_id',
            'vAlign' => 'middle',
            'width' => '50px',

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Wilaya::find()->orderBy('jina')->asArray()->all(), 'id', 'jina'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa shehia'],
            'value' => function ($model){
                return $model->wilaya->jina;
            }
        ],
        [
            'attribute' => 'mkoa_id',
            'vAlign' => 'middle',
            'width' => '50px',

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Mkoa::find()->orderBy('jina')->asArray()->all(), 'id', 'jina'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa shehia'],
            'value' => function ($model){
                return $model->mkoa->jina;
            }
        ],
        [
            'attribute' => 'kituo_id',
            'hAlign' => 'middle',
            'width' => '50px',
           // 'noWrap'=>false,

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Vituo::find()->orderBy('kituo')->asArray()->all(), 'id', 'kituo'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa kituo'],
            'value' => function ($model){
            if($model->kituo_id != null) {
                return $model->kituo->kituo;
            }
            }
        ],



        [
                'attribute' => 'jinsia',
                 'filterType' => GridView::FILTER_SELECT2,
            'filter' => ['M' => 'MWANAUME', 'F' => 'MWANAMKE'],
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa jinsia'],
            'format' => 'raw',
                'value' => function ($model){
                    if($model->jinsia == 'M'){
                        return 'MWANAUME';
                    }elseif($model->jinsia == 'F'){
                        return 'MWANAMKE';
                    }
                }
            ],
        'tarehe_kuzaliwa',
        [
                'attribute' => 'umri_sasa',
                'label' => 'Umri'
        ],
        [
            'attribute' => 'nambar',
            'label' => 'Kitambulisho'
        ],
        [
            'attribute' => 'status',
            'value' => function($model){
                return $model->statusLabel;
            },
        ],
        [
            'attribute' => 'anaishi',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ['1' => 'NDIYO', '0' => 'HAPANA'],
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa jinsia'],
            'format' => 'raw',
            'value' => function ($model){
                if($model->anaishi == 1){
                    return 'NDIYO';
                }elseif($model->anaishi == 0){
                    return 'HAPANA';
                }
            }
        ],
        [

            'class' => 'kartik\grid\BooleanColumn',
            'attribute' => 'mzee_finger_print',
            'label' => 'Finger print ya mzee',
            'value' => function ($model){
                if($model->mzee_finger_print != null){
                    return true;
                }else{
                    return false;
                }
            }
        ],

        [

            'class' => 'kartik\grid\BooleanColumn',
            'attribute' => 'msaidizi_id',
            'label' => 'Finger print ya msaidizi',
            'value' => function ($model){
                if($model->msaidizi_id != null){
                    return \backend\models\MsaidiziMzee::getFingerPrint($model->msaidizi_id);
                }else{
                    return false;
                }
            }
        ],




    ];





    $dynagrid = DynaGrid::begin([
        //'dataProvider'=> $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'theme'=>'panel-info',
        'showPersonalize'=>true,
        'storage' => 'session',
        'gridOptions'=>[
            'dataProvider'=>$dataProvider,
           // 'filterModel'=>$searchModel,
            'striped'=>true,
            'showPageSummary' => true,
            'hover'=>true,
            'toolbar' =>  [

                ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'],
                '{export}',
            ],
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
        'heading' => 'Ripoti ya wazee',
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
                'filename' => Yii::t('kvgrid', 'Zups - Repoti ya wazee'),
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
                'filename' => 'ZUPS - RIPOTI YA WAZEE',
                'options' => ['title' => 'Repoti ya wazee'],
            ],
        ],
        ],
        'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
    ]);

    if (substr($dynagrid->theme, 0, 6) == 'simple') {
        $dynagrid->gridOptions['panel'] = false;
    }
    DynaGrid::end();
    ?>

</div>
