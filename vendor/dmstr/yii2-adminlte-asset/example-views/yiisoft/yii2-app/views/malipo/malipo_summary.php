<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MalipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Malipo');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malipo-index">
    <hr/>
    <?php
    $curentMonth = date('m');
    $previousOne = $curentMonth - 1;
    $previousTwo = $previousOne - 1;
    if(strlen($previousTwo<2)){
        $previousTwo = sprintf("%01d",$previousTwo);
    }
    if(strlen($previousOne<2)){
        $previousOne = sprintf("%01d",$previousOne);
    }
    ?>
    <?php
    $gridColumns = [
        ['class'=>'kartik\grid\SerialColumn'],

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
                    'group' => true,

           ],
        [
            'attribute' => 'shehia_id',
            'vAlign' => 'middle',
            'width' => '100px',
            'group'=>true,  // enable grouping
            'subGroupOf'=>1, // supplier column index is the paren

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Shehia::find()->orderBy('jina')->asArray()->all(), 'id', 'jina'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa shehia'],
            'value' => function ($model){
                return $model->mzee->shehia->jina;
            }
        ],
            [
                'attribute' => 'voucher_id',
                'label' => 'Idadi ya walengwa',
                'vAlign' => 'middle',
                'width' => '10px',
                'filter' => '',

                'value' => function ($model){
                    return \backend\models\Malipo::getCountPerShehia($model->voucher_id,$model->shehia_id);
                }
            ],

        [
            'attribute' => 'voucher_id',
            'label' => 'KE',
            'filter' => '',
            'vAlign' => 'middle',
            'width' => '10px',

            'value' => function ($model){
                return \backend\models\Malipo::getCountFemalePerShehia($model->voucher_id,$model->shehia_id);
            }
        ],
        [
            'attribute' => 'voucher_id',
            'label' => 'ME',
            'filter' => '',
            'vAlign' => 'middle',
            'width' => '10px',

            'value' => function ($model){
                return \backend\models\Malipo::getCountMalePerShehia($model->voucher_id,$model->shehia_id);
            }
        ],
        [
            'attribute' => 'voucher_id',
            'label' => 'WALIOLIPWA',
            'filter' => '',
            'vAlign' => 'middle',
            'width' => '50px',

            'value' => function ($model){
                return \backend\models\Malipo::getCountPaidPerShehia($model->voucher_id,$model->shehia_id);
            }
        ],
        [
            'attribute' => 'voucher_id',
            'label' => 'WASIOLIPWA',
            'filter' => '',
            'vAlign' => 'middle',
            'width' => '50px',

            'value' => function ($model){
                return \backend\models\Malipo::getCountPendingPerShehia($model->voucher_id,$model->shehia_id);
            }
        ],
        [
            'attribute' => 'voucher_id',
            'label' => 'WALIOFARIKI',
            'filter' => '',
            'vAlign' => 'middle',
            'width' => '50px',

            'value' => function ($model){
                return \backend\models\Malipo::getCountDiedPerShehia($model->voucher_id,$model->shehia_id);
            }
        ],
        [
            'attribute' => 'shehia_id',
            'label' => 'WASIOLIPWA MWEZI WA '.$previousTwo,
            'filter' => '',
            'vAlign' => 'middle',
            'width' => '300px',

            'value' => function ($model,$previousTwo){
                return \backend\models\Malipo::getCountPreviousTwoPerShehia($previousTwo,$model->shehia_id);
            }
        ],
        [
            'attribute' => 'shehia_id',
            'label' => 'WASIOLIPWA MWEZI WA '.$previousOne,
            'filter' => '',
            'vAlign' => 'middle',
            'width' => '300px',

            'value' => function ($model,$previousOne){
                return \backend\models\Malipo::getCountPreviousOnePerShehia($previousOne,$model->shehia_id);
            }
        ],

           // 'siku_kwanza',
           // 'siku_pili',
          //  'siku_mwisho',



            /*[
                'attribute' => 'status',
                'vAlign' => 'middle',
                'width' => '100px',

                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \backend\models\Malipo::getStatus(),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    //'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Tafuta kwa Status'],
                'value' => function ($model){
                    if($model->status == \backend\models\Malipo::PENDING) {
                        return 'PENDING';
                    }elseif ($model->status == \backend\models\Malipo::PAID){
                        return 'PAID';
                    }elseif ($model->status == \backend\models\Malipo::EXPIRED){
                        return 'EXPIRED';
                    }

                }
            ],*/



            ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'showPageSummary' => true,
        'striped'=>true,
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
        'heading' => 'REPOTI YA MWEZI WA '.$curentMonth.' KWA UFUPI',
        'before'=>'<span class="text text-primary">Hii repoti inaonesha jinsi malipo yalivofanyika kwa mwezi huu wa : '.$curentMonth.'</span>',
    ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 10],
   // 'exportConfig' => $gridColumns

    ]);
    ?>
</div>
