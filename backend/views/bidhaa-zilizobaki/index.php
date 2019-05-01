<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BidhaaZilizobakiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bidhaa Zilizobakis';
$this->params['breadcrumbs'][] = $this->title;
?>

<hr/>
<div class="row">
    <div class="col-md-6">
        <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA BIDHAA ZILIZOBAKI STORE</strong>
    </div>
    <div class="col-md-2">

    </div>

</div>
<hr/>
<div class="bidhaa-zilizobaki-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'bidhaa_id',
                'label' => 'Jina la bidhaa',
                'value' => function ($model){

                    return $model->bidhaa->aina->hitaji;
                }
            ],
            'idadi',
            'aliyeingiza',
            'muda',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
