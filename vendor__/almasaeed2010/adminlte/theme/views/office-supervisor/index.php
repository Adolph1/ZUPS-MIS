<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OfficeSupervisorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Matumiz mbali mbali ya Office Supervisors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="office-supervisor-index">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA MATUMIZI</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Matumizi Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Matumizi'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
           [
                   'attribute' => 'aina_id',
                    'value' => 'aina.matumizi',
            ],
            'kiasi',
            'maelezo',
            [
                'attribute' => 'budget_id',
                'value' => 'budget.kumbukumbu_no',
            ],
            'kiambatanisho',
            // 'aliyeweka',
            // 'muda',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
