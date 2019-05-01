<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RejectionReasonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rejection Reasons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rejection-reason-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rejection Reason', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'reason',
            'maker_id',
            'maker_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
