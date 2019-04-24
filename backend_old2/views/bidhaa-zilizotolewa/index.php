<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BidhaaZilizotolewaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bidhaa Zilizotolewa';
$this->params['breadcrumbs'][] = $this->title;
?>

<hr/>
<div class="row">
    <div class="col-md-12">
        <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA BIDHAA ZILIZOTOKA NJE YA STORE KWA MATUMIZI</strong>
    </div>
    <div class="col-md-2">

    </div>

</div>
<hr/>
<div class="bidhaa-zilizotolewa-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'tarehe_ya_kutoka',
            'bidhaa_id',
            'jina_aliyetoa',
            'idadi',
            //'jumla',
            //'aliyepokea',
            //'aliyeingiza',
            //'muda',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
