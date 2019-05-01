<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductAccroleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounting Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-accrole-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add role', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'account_role',
            'product_code',
            'role_type',
            'status',
            'account_head',
            // 'description',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>

</div>
