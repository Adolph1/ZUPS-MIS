<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BudgetMonthlyBalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bajeti zilizofungwa mahesabu yake';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-monthly-balance-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            [
                'attribute' => 'budget_id',
                'value' => function($model){

                    return $model->budget->kwa_mwezi. '/'. $model->budget->kwa_mwaka;
                }
            ],
            [
                'attribute' => 'opening_balance',
                'format' => ['decimal',2]
            ],
            [
                'attribute' => 'closing_balance',
                'format' => ['decimal',2]
            ],
            [
                'attribute' => 'balance',
                'format' => ['decimal',2]
            ],


           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
