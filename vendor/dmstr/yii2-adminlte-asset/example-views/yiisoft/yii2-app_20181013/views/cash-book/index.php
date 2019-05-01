<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cash Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-book-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA MIAMALA</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Muamala Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Miamala'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'trn_dt',
            'gl_account',

            [
                    'attribute' => 'dr_cr',
                    'label' => 'Credit',
                    'value' => function ($model){
                        if($model->dr_cr == 'C'){
                            return $model->amount;
                        }else{
                            return '';
                        }
                    }
            ],
            [
                'attribute' => 'dr_cr',
                'label' => 'Debit',
                'value' => function ($model){
                    if($model->dr_cr == 'D'){
                        return $model->amount;
                    }else{
                        return '';
                    }
                }
            ],
           // 'dr_cr',
            'description',
            // 'auth_stat',
            // 'delete_stat',
            // 'maker_id',
            // 'maker_time',

            ['class' => 'yii\grid\ActionColumn','header' => 'Actions'],
        ],
    ]); ?>
</div>
