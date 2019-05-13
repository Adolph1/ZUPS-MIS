<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ZupsBudgetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orodha ya Budget kuu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zups-budget-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'mwezi',
            'mwaka',
            [
                    'label' => 'Jumla',
                    'format' =>['decimal',2],
                    'value' => function($model){

                        return \backend\models\Budget::getMonthlySum($model->id);

                    }
            ],

            [
                'label' => 'Maelezo zaid',
                'value' => function($model){
                    $budgets = \backend\models\Budget::find()->where(['zups_budget_id' => $model->id])->all();
                    if(count($budgets) == 1){
                        foreach ($budgets as $budget) {
                            if ($budget->zone_id == \backend\models\Zone::UNGUJA) {
                                return 'UNGUJA';
                            } elseif ($budget->zone_id == \backend\models\Zone::PEMBA) {
                                return 'PEMBA';
                            }
                        }
                        }else{
                       return 'UNGUJA,PEMBA';
                    }

                }
            ],


            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'View',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['budget/monthly','id' => $model->id];
                        return Html::a('<span class="fa fa-arrow-right"></span>', $url, [
                            'title' => 'angalia budget',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },


                ]
            ],
        ],
    ]); ?>
</div>
