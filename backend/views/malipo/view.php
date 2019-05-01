<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Malipo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Malipos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malipo-view">

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
            'voucher_id',
            'siku_kwanza',
            'siku_pili',
            'siku_mwisho',
            'shehia_id',
            'mzee_id',
            'kiasi',
            'tarehe_kulipwa',
            'cashier_id',
            'device_number',
            'kituo_id',
            'status',
            'aliyelipwa',
            'muda',
        ],
    ]) ?>

</div>
