<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ToaMafutaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Toa Mafutas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toa-mafuta-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'tarehe',
            [
                'attribute' => 'wilaya_id',
                'value' => 'wilaya.jina'
            ],
            [
                'attribute' => 'bidhaa_id',
                'value' => 'bidhaa.hitaji'
            ],
           [
                   'attribute' => 'gari',
                    'value' => 'vehicle.plate_number'
           ],
            'kiasi',
            //'vocha',
            //'maker_id',
            //'maker_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
