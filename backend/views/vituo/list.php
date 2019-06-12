<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;
use kartik\grid\GridView;

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
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - MALIPO TEMPLATE</strong>
        </div>
    </div>
    <hr/>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'kituo',
            [
                    'label' => 'Jina la Afisa',
                'value' => function(){
                    return '';
                }
            ],
            [
                'label' => 'Kiasi',
                'format' => ['decimal',2],
                'value' => function(){
                    return 20000.00;
                }
            ],
            [
                'label' => 'Tarehe ya Malipo',
                'value' => function(){
                    return date('Y-m-d');
                }
            ],
            [
                'label' => 'kituo namba',
                'value' => 'id'
            ],
            [
                'label' => 'Kazi',
                'value' => function(){
                    return '';
                }
            ],

        ],
         'pjax'=>true,

        // set export properties
        'export' => [
            'fontAwesome' => true,

        ],
        'exportConfig' => [
            ExportMenu::FORMAT_EXCEL_X => [
                'label' => Yii::t('kvexport', 'Excel 2007+'),
                //'icon' => $isFa ? 'file-excel-o' : 'floppy-remove',
                'iconOptions' => ['class' => 'text-success'],
                'linkOptions' => [],
                'options' => ['title' => Yii::t('kvexport', 'Microsoft Excel 2007+ (xlsx)')],
                'alertMsg' => Yii::t('kvexport', 'The EXCEL 2007+ (xlsx) export file will be generated for download.'),
                'mime' => 'application/application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'extension' => 'xlsx',
                'writer' => ExportMenu::FORMAT_EXCEL_X
            ],
                ],
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            // 'beforeGrid'=>'My fancy content before.',
            //'afterGrid'=>'My fancy content after.',
        ],
        'panel' => [
            'type' => GridView::TYPE_INFO,
            //'heading' => 'Orodha ya wazee Waliohakikiwa katika shehia mbalimbali',
            //'before' => '<span class ="text text-orange">* Wanatakiwa kuthibitishwa kama wanakubaliwa ama wanakataliwa *</span>'
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        // 'exportConfig' => $gridColumns


    ]); ?>
</div>
