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

    <?=Html::beginForm(['mzee/sitisha'],'post');?>
    <?php
    $mikoas = \backend\models\Mkoa::find()->select('id')->where(['zone_id' => \backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
    $wilayas = \backend\models\Wilaya::find()->select('id')->where(['in', 'mkoa_id', $mikoas]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],

        /*[
            'attribute' => 'picha',
            'format' => 'html',
            'value' =>  function ($model){
                if($model->picha !=null) {
                    return Html::img('uploads/wazee/' . $model->picha,
                        ['width' => '60px', 'height' => '60px', 'class' => 'img-circle']);
                }else{
                    return Html::img('uploads/wazee/avatar.jpg',
                        ['width' => '60px', 'height' => '60px', 'class' => 'img-circle']);
                }

            }
        ],*/
        //'fomu_namba',
        // 'majina_mwanzo',
        [
            'attribute' => 'majina_mwanzo',
            'label' => 'Jina Kamili',
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
            'value' => function ($model) {
                return \backend\models\Mzee::getFullname($model->id);

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
            'value' => function ($model) {
                if ($model->jinsia == 'M') {
                    return 'MWANAUME';
                } elseif ($model->jinsia == 'F') {
                    return 'MWANAMKE';
                }
            }
        ],
        [
            'attribute' => 'nambar',
            'label' => 'Kitambulisho'
        ],



        [
            'attribute' => 'msaidizi_id',
            'vAlign' => 'middle',
            'label'=>'Mtu wa karibu',

            //   'filterInputOptions' => ['placeholder' => 'Tafuta kwa Jina'],
            //  'format' => 'raw',
            'value' => function ($model){
                if($model->msaidizi_id != null) {
                    return $model->msaidizi->jina_kamili;
                }

            }
        ],
        [
            'attribute' => 'shehia_id',
            'vAlign' => 'middle',
            'width' => '50px',

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Shehia::find()->where(['in', 'wilaya_id', $wilayas])->orderBy('jina')->asArray()->all(), 'id', 'jina'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa shehia'],
            /*   'value' => function ($model) {
                   return $model->shehia->jina;
               }*/
            'value'=>'shehia.jina'
        ],



    ];


    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'pjax' => true,
        'toolbar' =>  [

            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        'exportConfig' => [
            GridView::EXCEL => [
                'filename' => Yii::t('app', 'WAZEE WANAO SUBILI MALIPO'),
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
            GridView::PDF => [
                'filename' => Yii::t('app', 'WAZEE WANAO SUBILI MALIPO'),
                'showPageSummary' => true,
                'showHeader' => true,
                'showFooter' => false,
                'title' => 'Preceptors',
                'options' => ['title' => 'WAZEEE'],

                'config' => [
                    'methods' => [
                        'SetHeader' => [
                            ['odd' => 'WAZEE WANAO SUBILI MALIPO', 'even' => 'WAZEE']
                        ],
                        'SetFooter' => [
                            ['odd' => 'header', 'even' => 'header']
                        ],
                    ],
                ],
           //     'options' => ['title' => Yii::t('app', 'Comma Separated Values')],

            ],
            GridView::JSON => [
               'filename' => Yii::t('app', 'WAZEE WANAO SUBILI MALIPO'),
                'showPageSummary' => true,
                'options' => ['title' => Yii::t('app', 'Comma Separated Values')],

            ],

        ],

        'pjaxSettings' => [
            'neverTimeout' => true,
            // 'beforeGrid'=>'My fancy content before.',
            //'afterGrid'=>'My fancy content after.',
        ],
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => 'Ripoti ya wazee eligibles',
            // 'before' => '<span class="text text-red"> *Eligible*</span>'
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        // 'exportConfig' => $gridColumns

    ]);


    ?>
    <?= Html::endForm();?>
</div>
</div>