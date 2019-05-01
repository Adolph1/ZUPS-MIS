<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BudgetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Budgets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-index">
    <hr/>
    <?=Html::beginForm(['budget/bulk-approve'],'post');?>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA BUDGET</strong>
        </div>
        <div class="col-md-2">

        </div>
    </div>
    <hr/>

   <?php

   $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],

       ['class' => '\kartik\grid\CheckboxColumn',
           'checkboxOptions' => function ($model, $key, $index, $column) {
               if ($model->status == \backend\models\Budget::OPEN) {
                   return ['value' => $key];
               }
               return ['style' => ['display' => 'none']]; // OR ['disabled' => true]
           },
       ],
       [


           'attribute' => 'zone_id',
           'label' => 'Zone',
           'value' => 'zone.jina',

       ],
            [


                'attribute' => 'kumbukumbu_no',
                'pageSummary' => 'JUMLA KUU',

            ],

       'kwa_mwezi',
       'kwa_mwaka',

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



           'aliyeweka',
            'muda',
       [
           'attribute' => 'status',
           'value' => function($model){
               return $model->statusLabel;
           },
       ],
            'aliyethitisha',
             'muda_kuthibitisha',

            [
                'class'=>'kartik\grid\ActionColumn',
                'header'=>'Mchanganuo',
                'template'=>'{wazee} {uendeshaji}',
                'buttons'=>[
                    'wazee' => function ($url, $model) {
                        $url=['wazee','id' => $model->id];
                        return Html::a('<span class="fa fa-money"></span>', $url, [
                            'title' => 'Wazee',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-success',

                        ]);


                    },
                    'uendeshaji' => function ($url, $model) {
                        $url=['uendeshaji','id' => $model->id];
                        return Html::a('<span class="fa fa-money"></span>', $url, [
                            'title' => 'Uendeshaji',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-success',

                        ]);


                    },


                ]
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
                Html::submitButton('<i class="fa fa-check"></i> Approve',
                    [
                        'class' =>Yii::$app->user->can('approveBudget') ? 'btn btn-warning enabled':'btn btn-default disabled',
                    ]
                ),
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
            'heading' => 'BUDGET ZA KILA MWEZI',
            'before'=>'<span class="text text-primary"></span>',
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        // 'exportConfig' => $gridColumns

    ]);
    ?>
</div>
