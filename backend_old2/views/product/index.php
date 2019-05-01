<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'System Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <?= Html::a(Yii::t('app', '<i class="fa fa-money text-yellow"></i> NEW PRODUCT'), ['create'], ['class' => 'btn btn-default text-green']) ?>

        <?= Html::a(Yii::t('app', '<i class="fa fa-th text-yellow"></i> PRODUCT LIST'), ['index'], ['class' => 'btn btn-default text-green']) ?>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'product_id',
            'product_descption',
            //'product_type',
            //'product_module',
            'product_group',
            'product_remarks',
            //'product_start_date',
            //'product_end_date',

            // 'maker_id',
            // 'maker_stamptime',
            // 'checker_id',
            // 'checker_stamptime',
            'record_stat',
            // 'mod_no',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
    </div>

</div>
