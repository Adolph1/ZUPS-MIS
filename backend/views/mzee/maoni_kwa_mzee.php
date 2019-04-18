<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MalipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$searchModel = new \backend\models\MaoniKwaMzeeeSearch();
$dataProvider = $searchModel->searchByMzeeId($model->id);
?>
<div class="malipo-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary' =>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],


            [
                    'attribute' =>'sababu',
                    'label' => '',
            ],
         ],

    ]); ?>
</div>
