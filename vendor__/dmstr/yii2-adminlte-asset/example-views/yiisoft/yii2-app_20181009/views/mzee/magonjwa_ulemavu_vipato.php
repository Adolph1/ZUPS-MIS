<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MalipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$searchModel = new \backend\models\MzeeMagonjwaSearch();
$dataProvider = $searchModel->searchByMzeeId($model->id);
$searchModel1 = new \backend\models\MzeeUlemavuSearch();
$dataProvider1 = $searchModel1->searchByMzeeId($model->id);
$searchModel2 = new \backend\models\MzeeVipatoSearch();
$dataProvider2 = $searchModel2->searchByMzeeId($model->id);
?>
<div class="row">
    <div class="col-sm-4">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
       // 'rowOption'=>false,
        'summary' => '',
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

            //'id',
           // 'mzee_id',
            [
                'attribute' => 'ugonjwa_id',
                'label' => 'Magonjwa',
                'value' =>  'ugonjwa1.ugonjwa',
            ],
            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'',
                'template'=>'{delete}',
                'buttons'=>[
                    'delete' => function ($url, $model) {
                        $url=['mzee-magonjwa/delete','id' => $model->id];
                        return Html::a('<span class="fa fa-times text-danger"></span>', $url, [
                            'title' => 'Delete',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],

                        ]);


                    },

                ]
            ]
        ],
    ]); ?>
    </div>
    <div class="col-sm-4">
        <?= GridView::widget([
            'dataProvider' => $dataProvider1,
            //'filterModel' => $searchModel,
           // 'rowVisible'=>false,
            'summary' => '',
            'columns' => [
                //  ['class' => 'yii\grid\SerialColumn'],

                //'id',
                // 'mzee_id',
                [
                        'attribute' => 'ulemavu_id',
                        'label' => 'Ulemavu',
                        'value' =>  'ulemavu.jina',
                ],
                [
                    'class'=>'yii\grid\ActionColumn',
                    'header'=>'',
                    'template'=>'{delete}',
                    'buttons'=>[
                        'delete' => function ($url, $model) {
                            $url=['mzee-ulemavu/delete','id' => $model->id];
                            return Html::a('<span class="fa fa-times text-danger"></span>', $url, [
                                'title' => 'Delete',
                                'data-toggle'=>'tooltip','data-original-title'=>'Save',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],

                            ]);


                        },

                    ]
                ]
            ],
        ]); ?>
    </div>
    <div class="col-sm-4">
        <?= GridView::widget([
            'dataProvider' => $dataProvider2,
            //'filterModel' => $searchModel,
           // 'rowVisible'=>false,
            'summary' => '',
            'columns' => [
                //  ['class' => 'yii\grid\SerialColumn'],

                //'id',
                // 'mzee_id',
                [
                    'attribute' => 'kipato_id',
                    'label' => 'Vipato',
                    'value' =>  'kipato.kipato',
                ],
                //  'aliyeweka',
                // 'muda',

                [
                    'class'=>'yii\grid\ActionColumn',
                    'header'=>'',
                    'template'=>'{delete}',
                    'buttons'=>[
                        'delete' => function ($url, $model) {
                            $url=['mzee-vipato/delete','id' => $model->id];
                            return Html::a('<span class="fa fa-times text-danger"></span>', $url, [
                                'title' => 'Delete',
                                'data-toggle'=>'tooltip','data-original-title'=>'Save',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],

                            ]);


                        },

                    ]
                ]
            ],
        ]); ?>
    </div>
</div>
