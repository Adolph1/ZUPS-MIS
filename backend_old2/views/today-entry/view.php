<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TodayEntry */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Today Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="today-entry-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'id',
            'module',
            'trn_ref_no',
            'trn_dt',
            'entry_sr_no',
            'ac_no',
            'ac_branch',
            'event_sr_no',
            'event',
            'amount',
            'amount_tag',
            'drcr_ind',
            'trn_code',
            'related_customer',
            'batch_number',
            'product',
            'value_dt',
            'finacial_year',
            'period_code',
            'maker_id',
            'maker_stamptime',
            'checker_id',
            'auth_stat',
            'delete_stat',
            'instrument_code',
        ],
    ]) ?>

</div>
