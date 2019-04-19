<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductAccrole */

$this->title = $model->account_role;
$this->params['breadcrumbs'][] = ['label' => 'Product Accroles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-accrole-view">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'account_role',
            'product_code',
            'role_type',
            'status',
            'account_head',
            'description',
        ],
    ]) ?>

</div>
