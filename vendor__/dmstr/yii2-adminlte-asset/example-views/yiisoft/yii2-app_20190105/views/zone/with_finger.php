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
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA WAZEE WALIOCHUKULIWA FINGER PRINT</strong>
        </div>
        <div class="col-md-2">

        </div>

    </div>
    <hr/>
    <?php
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
            'vAlign' => 'middle',
            'width' => '180px',

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Mzee::find()->orderBy('majina_mwanzo')->asArray()->all(), 'majina_mwanzo', 'majina_mwanzo'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                // 'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa majina ya mwanzo'],
            'format' => 'raw'
        ],
        [
            'attribute' => 'jina_babu',
            'vAlign' => 'middle',
            'width' => '180px',

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Mzee::find()->orderBy('jina_babu')->asArray()->all(), 'jina_babu', 'jina_babu'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa jina la babu'],
            'format' => 'raw'
        ],
        [
            'attribute' => 'shehia_id',
            'vAlign' => 'middle',
            'width' => '100px',

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
            'attribute' => 'kituo_id',
            'vAlign' => 'middle',
            'width' => '100px',

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Vituo::find()->orderBy('kituo')->asArray()->all(), 'id', 'kituo'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa kituo'],
            'value' => function ($model){
                return $model->kituo->jina;
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
        'umri_sasa',

        [
            'attribute' => 'aina_ya_kitambulisho',
            'value' => 'kitambulisho.jina'
        ],
        'nambar',

        [
            'attribute' => 'status',
            'filterType' => GridView::FILTER_SELECT2,
            'attribute' => 'status',
            'width' => '180px',
            'filter' => \backend\models\Mzee::getStatuses(),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                // 'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa status'],


            'value' => function($model) {
                return $model->statusLabel;
            }
        ],

        [
            'class'=>'yii\grid\ActionColumn',
            'header'=>'Actions',
            'template'=>'{view}',
            'buttons'=>[
                'view' => function ($url, $model) {
                    $url=['view','id' => $model->id];
                    return Html::a('<span class="fa fa-eye"></span>', $url, [
                        'title' => 'View',
                        'data-toggle'=>'tooltip','data-original-title'=>'Save',
                        'class'=>'btn btn-info',

                    ]);


                },

            ]
        ],
    ];





    echo GridView::widget([
        'dataProvider'=> $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
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
   // 'exportConfig' => $gridColumns

    ]);


    ?>
</div>
