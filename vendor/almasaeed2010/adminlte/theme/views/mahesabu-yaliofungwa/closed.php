<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MahesabuYaliofungwaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mahesabu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahesabu-index">
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - MAHESABU YALIYOFUNGWA TAYARI</strong>
        </div>
        <div class="col-md-3">

        </div>

    </div>
    <hr/>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],



            'tarehe_ya_kupewa',
            [
                'attribute' => 'cashier_id',
                'value' => 'cashier.jina_kamili'
            ],
            [
                'attribute' => 'kituo_id',
                'value' => 'kituo.kituo'
            ],

            'kiasi_alichopewa',
            'kiasi_kilichotumika',
            [
                'label' => 'Kiasi anachotakiwa kurejesha',
                'value' => function($model){
                    return $model->kiasi_alichopewa - $model->kiasi_kilichotumika;
                }
            ],

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-folder-open"></span>', $url, [
                            'title' => 'Fungua',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-default',

                        ]);


                    },

                ]
            ],
        ],
    ]); ?>
</div>
