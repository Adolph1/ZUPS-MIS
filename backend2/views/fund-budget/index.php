<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FundBudgetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fund Budgets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fund-budget-index">

    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - FUND BUDGET</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Fund Budget'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Funds'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            [
                    'attribute' => 'budget_id',
                    'value' => function($model){

                        return $model->budget->kwa_mwezi.' / ' .$model->budget->kwa_mwaka;
                    }
            ],
            [
                    'attribute' => 'wazee',
                    'format' => ['decimal',2],

            ],
            [
                'attribute' => 'uendeshaji',
                'format' => ['decimal',2],

            ],
            [
                'attribute' => 'jumla',
                'format' => ['decimal',2],

            ],
            [
                'attribute' => 'kiasi_kilichotolewa',
                'format' => ['decimal',2],

            ],
            [
                'attribute' => 'bakaa',
                'format' => ['decimal',2],

            ],

            'aliyeingiza',
            'muda',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
