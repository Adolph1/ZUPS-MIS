<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MahesabuBreakdownSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mahesabu Breakdowns');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahesabu-breakdown-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Mahesabu Breakdown'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'mahesabu_id',
            'kiasi_kilichobaki',
            'tarehe',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
