<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BudgetMonthlyBalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Budget Monthly Balances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-monthly-balance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Budget Monthly Balance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'budget_id',
            'opening_balance',
            'closing_balance',
            'balance',
            //'last_update',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
