<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BidhaaZilizoingiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bidhaa Zilizoingia';
$this->params['breadcrumbs'][] = $this->title;
?>

<hr/>
<div class="row">
    <div class="col-md-6">
        <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA BIDHAA ZILIZOINGIA STORE</strong>
    </div>
    <div class="col-md-2">

    </div>

</div>
<hr/>
<div class="bidhaa-zilizoingia-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'tarehe_ya_kuingia',
           [
                   'attribute' => 'bidhaa_id',
                    'label' => 'Jina la bidhaa',
                    'value' => function ($model){

                        return $model->bidhaa->aina->hitaji;
                    }
           ],
            'idadi',
            'jina_aliyeleta',


        ],
    ]); ?>
</div>
