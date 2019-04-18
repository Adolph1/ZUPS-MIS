<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WazeeWaliotenguliwaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wazee Waliotenguliwas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wazee-waliotenguliwa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Wazee Waliotenguliwa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
             [
                   'attribute' => 'mzee_id',
                    'value' => function ($model){
                        return $model->mzee->majina_mwanzo. ' ' .$model->mzee->jina_babu;
                    }
           ],
            'sababu',
            'aliyeingiza',
            'muda',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
