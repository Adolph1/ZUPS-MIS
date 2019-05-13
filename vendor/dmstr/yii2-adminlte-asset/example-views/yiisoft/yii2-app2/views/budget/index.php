<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BudgetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Budgets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-index">
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - BUDGET MPYA</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Budget Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Budgets'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'maelezo',
           [
                   'attribute' => 'jumla_kiasi',
                    'value' => function ($model){
                        return \backend\models\GharamaMahitaji::getSum($model->id);
                    }
           ],
            'kumbukumbu_no',
            'kwa_mwezi',
            'kwa_mwaka',
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status == \backend\models\Budget::OPEN){
                        return "PENDING";
                    }elseif ($model->status == \backend\models\Budget::FUNDED){
                        return "FUNDED";
                    }
                }
            ],
           // 'aliyeweka',
            // 'muda',
            // 'aliyethitisha',
            // 'muda_kuthibitisha',
    [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Copy',
                'template'=>'{clone}',
                'buttons'=>[
                    'clone' => function ($url, $model) {
                        $url=['clone','id' => $model->id];
                        return Html::a('<span class="fa fa-copy"></span>', $url, [
                            'title' => 'Copy',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-warning',

                        ]);


                    },

                ]
            ],
            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'View',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-arrow-right"></span>', $url, [
                            'title' => 'View',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },


                ]
            ],

        ],
    ]); ?>
</div>
