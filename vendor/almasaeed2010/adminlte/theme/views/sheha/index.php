<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShehaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Shehas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sheha-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-users"></i> ZUPS - MASHEHA</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-user"></i> Sheha Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Masheha'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'jina_kamili',
            'mtaa',
            'nyumba_namba',
            [
                    'attribute' => 'jinsia',
                    'value' => function ($model){
                    if($model->jinsia == 'F'){
                        return 'Mke';
                    }elseif ($model->jinsia == 'M'){
                        return 'Mume';
                    }
                    }
            ],
             'simu',

            [
                    'attribute' => 'wilaya_id',
                    'value' => 'wilaya.jina'
            ],

            // 'tarehe_kuzaliwa',
            // 'shehia_id',
            // 'aliyeweka',
            // 'muda',

            ['class' => 'yii\grid\ActionColumn','header' => 'Actions'],
        ],
    ]); ?>
</div>
