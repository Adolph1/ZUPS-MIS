<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductEventEntry */

$this->title = $model->product_code;
$this->params['breadcrumbs'][] = ['label' => 'Product Event Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-event-entry-view">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->product_code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->product_code], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'product_code',
            'transaction_code',
            'dr_cr_indicator',
            'event_code',
            'account_role_code',
            'role_type',
            'mis_head',
        ],
    ]) ?>

</div>
