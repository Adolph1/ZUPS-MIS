<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KituoCashierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kituo Cashiers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kituo-cashier-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - CASHIERS WA VITUO MBALIMBALI</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">



        </div>
    </div>
    <hr/>
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'cashier_id',
                'value' => 'cashier.jina_kamili'
            ],
            [
                'attribute' => 'kituo_id',
                'value' => 'kituo.kituo'
            ],

            ['class' => 'yii\grid\ActionColumn','header' => 'Actions'],
        ],
    ]); ?>
</div>
