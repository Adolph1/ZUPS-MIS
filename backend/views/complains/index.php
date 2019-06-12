<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComplainsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Complains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complains-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA COMPLAINTS</strong>
        </div>

    </div>
    <hr/>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'created_date',
            'full_name',
            'email:email',
            'title',
            'notes:ntext',


            //
            // 'created_at',

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-eye"></span>', $url, [
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
