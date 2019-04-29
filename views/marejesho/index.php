<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MarejeshoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marejeshos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marejesho-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Marejesho', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tarehe',
            'mahesabu_id',
            'kiasi',
            'kilichobaki',
            //'aliyepokea',
            //'muda_alioingiza',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
