<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShehaMasaidiziSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sheha Masaidizis');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sheha-masaidizi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sheha Masaidizi'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sheha_id',
            'jina_kamili',
            'tarehe_kuzaliwa',
            'anuani_kamili',
            // 'nambari_ya_simu',
            // 'aliyeweka',
            // 'muda',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
