<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HamishaMzeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wazee Waliohamishwa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hamisha-mzee-index">

    <h5><?= Html::encode($this->title) ?></h5>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'mzee_id',
                'label' => 'Jina Kamili la mzee',
                'value' => function($model){
                    return \backend\models\Mzee::getFullname($model->mzee_id);
                }
            ],
            [
                'attribute' => 'mkoa_anaokwenda',
                'value' => function($model){
                    return $model->mkoa->jina;
                }
            ],
            [
                'attribute' => 'wilaya_anayokwenda',
                'value' => function($model){
                    return $model->wilaya->jina;
                }
            ],
            [
                'attribute' => 'shehia_anayokwenda',
                'value' => function($model){
                    return $model->shehia->jina;
                }
            ],

            'sababu',
            [
                'attribute' => 'mkoa_aliotoka',
                'value' => function($model){
                    return $model->fromMkoa->jina;
                }
            ],
            [
                'attribute' => 'wilaya_aliyotoka',
                'value' => function($model){
                    return $model->fromWilaya->jina;
                }
            ],
            [
                'attribute' => 'shehia_aliyotoka',
                'value' => function($model){
                    return $model->fromShehia->jina;
                }
            ],
            'tarehe',

            ///'aliyeingiza',
            //'muda',


            [
                'class'=>'kartik\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['un-do','id' => $model->id];
                        return Html::a('<span class="fa fa-retweet"></span>', $url, [
                            'title' => 'Tengua',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-warning',

                        ]);


                    },

                ]
            ],
        ],
    ]); ?>
</div>
