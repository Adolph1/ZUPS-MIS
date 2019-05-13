<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FuelManagementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fuel Managements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fuel-management-index">

    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - MGAWANYO WA MAFUTA</strong>
        </div>

        <div class="col-md-6">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Gawa Mafuta'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Magari yaliyopewa mafuta'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'vehicle_id',
            'kiasi_cha_mafuta',
            'tarehe',
            'dereva',
            //'aliyeingiza',
            //'muda',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
