<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductEventEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Event Entries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-event-entry-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Event Entry', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'product_code',
            'transaction_code',
            'dr_cr_indicator',
            'event_code',
            'account_role_code',
            // 'role_type',
            // 'mis_head',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>

</div>
