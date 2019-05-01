<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\HallSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Halls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hall-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hall', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'owner',
            'type',
            'price',
            // 'people_volume',
            // 'email:email',
            // 'phone',
            // 'photo',
            // 'food_beverage_inclusive',
            // 'decoration_inclusive',
            // 'location',
            // 'status',
            // 'maker_id',
            // 'maker_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
