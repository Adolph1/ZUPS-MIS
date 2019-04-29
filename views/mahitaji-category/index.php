<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MahitajiCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mahitaji Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahitaji-category-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - AINA YA MAHITAJI</strong>
        </div>
        <div class="col-md-2">

        </div>

    </div>
    <hr/>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'jina',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
