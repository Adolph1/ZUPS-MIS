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
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA WAZEE WALIOCHUKULIWA FINGER PRINT</strong>
        </div>
        <div class="col-md-2">

        </div>

    </div>
    <hr/>
    <?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'mkoa_id',
            'value' => function($model){
                if($model->mkoa_id !=null){
                    return $model->shehia->wilaya->mkoa->jina;
                }else{
                    return ' ';
                }
            },
           'width'=>'100px',
            'label' => 'Mkoa',
            'group' => true,

        ],
        [
            'attribute' => 'wilaya_id',
            'value' => function($model){
                if($model->wilaya_id !=null){
                    return $model->shehia->wilaya->jina;
                }else{
                    return ' ';
                }
            },
            'width'=>'100px',
            'label' => 'Wilaya',
            'group'=>true,  // enable grouping
            'subGroupOf'=>1, // supplier column index is the paren


        ],
        [
            'attribute' => 'kituo_id',
            'value' => function($model){
                if($model->kituo_id !=null){
                    return $model->kituo->kituo;
                }else{
                    return ' ';
                }
            },
            'width'=>'100px',
            'label' => 'Kituo',
            'group'=>true,  // enable grouping
            'subGroupOf'=>1, // supplier column index is the paren


        ],
        [
            'attribute' => 'shehia_id',
            'pageSummary'=>'Jumla',
            'value' => function($model){
                if($model->shehia_id !=null){
                    return $model->shehia->jina;
                }else{
                    return ' ';
                }
            },
            'width'=>'100px',
            'label' => 'Shehia',

           // 'group'=>true,  // enable grouping
           // 'subGroupOf'=>3, // supplier column index is the paren


        ],

        [
            'attribute' => 'shehia_id',
            'label' => 'Idadi ya walengwa',
            'vAlign' => 'middle',
            'pageSummary'=>true,
            'width'=>'100px',
            'filter' => '',

            'value' => function ($model){
                return \backend\models\Mzee::getCountPerShehia($model->shehia_id);
            }
        ],
        [
            'attribute' => 'shehia_id',
            'label' => 'Wenye Finger print',
            'vAlign' => 'middle',
            'width'=>'100px',
            'filter' => '',
            'pageSummary'=>true,

            'value' => function ($model){
                return \backend\models\Mzee::getCountPerShehiaWithFinger($model->shehia_id);
            }
        ],
        [
            'attribute' => 'shehia_id',
            'label' => 'Finger print za wasaidizi',
            'vAlign' => 'middle',
            'width'=>'100px',
            'filter' => '',
            'pageSummary'=>true,

            'value' => function ($model){
                return \backend\models\Mzee::getCountPerShehiaMsaidiziFinger($model->shehia_id);
            }
        ],
        [
            'attribute' => 'shehia_id',
            'label' => 'Wasio na finger print',
            'vAlign' => 'middle',
            'width'=>'100px',
            'filter' => '',
            'pageSummary'=>true,

            'value' => function ($model){
                return \backend\models\Mzee::getCountPerShehiaNoFinger($model->shehia_id);
            }
        ],
        [
            'attribute' => 'shehia_id',
            'label' => 'Asilimia ya wenye finger print',
            'vAlign' => 'middle',
            'width'=>'100px',
            'filter' => '',
            'format' => ['decimal', 2],
            'pageSummary'=>true,

            'value' => function ($model){
                return (100 * \backend\models\Mzee::getCountPerShehiaWithFinger($model->shehia_id)/(\backend\models\Mzee::getCountPerShehia($model->shehia_id)));
            }
        ],
    ];





    echo GridView::widget([
        'dataProvider'=> $dataProvider,
        //'filterModel' => $searchModel,
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
    //'toggleDataOptions' => ['minCount' => 10],
   // 'exportConfig' => $gridColumns

    ]);


    ?>
</div>
