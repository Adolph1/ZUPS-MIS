<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UhakikiFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uhakiki Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uhakiki-form-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Uhakiki Form', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tarehe_ya_uhakiki',
            'aliyemhakiki',
            'mzee_id',
            'maoni_ya_uhakiki:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
