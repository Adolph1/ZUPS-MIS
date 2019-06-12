<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClerkKituoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clerk Kituos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clerk-kituo-index">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA CLERKS</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Clerk Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Clerks'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           [
                   'attribute' => 'kituo_id',
                    'value' => 'kituo.kituo'
           ],
            [
                'attribute' => 'user_id',
                'value' => 'cashier.jina_kamili'
            ],

            'date_assigned',
            'status',
            // 'maker_id',
            // 'maker_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
