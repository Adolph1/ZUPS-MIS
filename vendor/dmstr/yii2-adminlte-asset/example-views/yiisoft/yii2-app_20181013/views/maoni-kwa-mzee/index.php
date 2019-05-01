<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MaoniKwaMzeeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Maoni Kwa Mzees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maoni-kwa-mzee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Maoni Kwa Mzee'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'mzee_id',
            'sababu:ntext',
            'aliyeweka',
            'muda',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
