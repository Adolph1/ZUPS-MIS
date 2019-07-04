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
            ['class' => 'kartik\grid\SerialColumn'],

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
            GridView::EXCEL => [
                'filename' => Yii::t('app', 'MALIPO YA MAAFISA'),
                'showPageSummary' => true,
                'config' => [
                    'methods' => [
                        'SetHeader' => [
                            ['odd' => 'header', 'even' => 'header']
                        ],
                        'SetFooter' => [
                            ['odd' => 'header', 'even' => 'header']
                        ],
                    ],
                ],
                'options' => [
                    'title' => 'Custom Title',
                    'subject' => 'PDF export',
                    'keywords' => 'pdf'
                ],

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
