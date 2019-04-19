<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GharamaMahitajiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Gharama Mahitajis');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gharama-mahitaji-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Gharama Mahitaji'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'budget_id',
            'hitaji_id',
            'wilaya_id',
            'idadi_ya_siku',
            // 'idadi_ya_vitu',
            // 'gharama',
            // 'total',
            // 'aliyeweka',
            // 'muda',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
