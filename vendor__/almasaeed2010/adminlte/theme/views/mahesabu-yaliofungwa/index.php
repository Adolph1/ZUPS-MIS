<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MahesabuYaliofungwaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mahesabu Yaliofungwas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahesabu-yaliofungwa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Mahesabu Yaliofungwa'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tarehe_ya_kupewa',
            'cashier_id',
            'kituo_id',
            'kiasi_alichopewa',
            // 'kiasi_kilichotumika',
            // 'kiasi_alichorudisha',
            // 'kiasi_kilichobaki',
            // 'tarehe_ya_kufunga',
            // 'maelezo_zaid',
            // 'status',
            // 'aliyepokea',
            // 'muda',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
