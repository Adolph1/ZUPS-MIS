<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HamishaMzeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wazee waliohamia kwetu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hamisha-mzee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//'id',
            [
                'attribute' => 'mzee_id',
                'label' => 'Jina Kamili la mzee',
                'value' => function($model){
                    return \backend\models\Mzee::getFullname($model->mzee_id);
                }
            ],
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

            'tarehe',
            //'aliyeingiza',
           // 'muda',



        ],
    ]); ?>
</div>
