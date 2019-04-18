<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MalipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$searchModel = new \backend\models\UhakikiFormSearch();
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
                    'attribute' =>'tarehe_ya_uhakiki',

            ],
            'maoni_ya_uhakiki',
            'aliyemhakiki'
         ],

    ]); ?>
</div>
