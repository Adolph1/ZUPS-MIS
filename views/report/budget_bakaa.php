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
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - RIPOTI INAYOONESHA BAJETI MBALI MBALI</strong>
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
            'content' => 'MALIPO YA BAJETI',
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
        'kwa_mwezi',

        [


            'attribute' => 'kwa_mwaka',
            'pageSummary' => 'JUMLA KUU',

        ],


        [
            'attribute' =>  'kianzio',
            'format' => ['decimal',2],
            'pageSummary' => true,

        ],
        [
            'attribute' => 'wazee',
            'format' => ['decimal',2],
            'pageSummary' => true,

        ],

        [
            'attribute' => 'uendeshaji',
            'format' => ['decimal',2],
            'pageSummary' => true,

            'value' => function ($model){
                return \backend\models\GharamaMahitaji::getSum($model->id);
            }
        ],
        [
            'attribute' => 'jumla_kiasi',
            'pageSummary' => true,
            'format' => ['decimal',2],
            'value' => function ($model){
                return ($model->wazee+\backend\models\GharamaMahitaji::getSum($model->id))-$model->kianzio;
            }
        ],
        [
            'label' => 'Iliyolipa wazee',
            'format' => ['decimal',2],
            'pageSummary' => true,
            'value' => function($model){
                return \backend\models\KituoMonthlyBalances::getPaidBalancePerZone(\backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),$model->kwa_mwezi,$model->kwa_mwaka);
            },
        ],

        [
            'label' => 'bakaa',
            'format' => ['decimal',2],
            'pageSummary' => true,
            'value' => function($model){
                return \backend\models\KituoMonthlyBalances::getBalancePerZone(\backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),$model->kwa_mwezi,$model->kwa_mwaka);
            },
        ],


        [
            'label' => 'Iliotumika uendeshaji',
            'format' => ['decimal',2],
            'pageSummary' => true,
            'value' => function($model){
                return '';
            },
        ],
        [
            'label' => 'Bakaa',
            'format' => ['decimal',2],
            'pageSummary' => true,
            'value' => function($model){
                return '';
            },
        ],
        [
            'label' => 'Bakaa jumla',
            'format' => ['decimal',2],
            'pageSummary' => true,
            'value' => function($model){
                return '';
            },
        ],



    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'showPageSummary' => true,
        'pjax'=>true,
        'toolbar' =>  [
            ['content' =>
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['budget'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
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
            'heading' => 'RIPOTI YA BAJETI MBALIMBALI',
            'before'=>'<span class="text text-primary">' .$this->render('_budget', ['model' => $searchModel]).'</span>',
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        // 'exportConfig' => $gridColumns

    ]);
    ?>
</div>
