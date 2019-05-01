<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\KituoMonthlyBalances */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kituo Monthly Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kituo-monthly-balances-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kituo_id',
            'allocated_amount',
            'paid_amount',
            'balance',
            'month',
            'year',
            'allocated_by',
            'allocated_time',
            'allocated_to',
            'last_access',
            'last_access_user',
        ],
    ]) ?>

</div>
