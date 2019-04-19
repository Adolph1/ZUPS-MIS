<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CashBook */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cash Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-book-view">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - MUAMALA MPYA</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Muamala Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Miamala'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'trn_dt',
            'amount',
            'gl_account',
           [
                   'attribute' => 'dr_cr',
                    'value' => function($model){
                    if($model->dr_cr == 'C'){
                        return 'IN';
                    }elseif ($model->dr_cr == 'D'){
                        return 'OUT';
                    }
                    }
           ],
            'description',
           // 'auth_stat',
            //'delete_stat',
            'maker_id',
            'maker_time',
        ],
    ]) ?>


    <p style="float: right;">
        <?php
        if($model->delete_stat != 'R') {
            echo Html::a(Yii::t('app', 'Reverse'), ['reverse', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Unauhakika unataka ku-reverse muamala huu?'),
                    'method' => 'post',
                ],
            ]);
        }?>
    </p>


</div>
