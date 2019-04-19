<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ZoneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Zones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zone-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-sitemap"></i> ZUPS - ZONES</strong>
        </div>
        <div class="col-md-3">

        </div>

    </div>
    <hr/>
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'jina',
           // 'aliyeweka',
            //'muda',

           // ['class' => 'yii\grid\ActionColumn'],
        ],

    ]); ?>
</div>
