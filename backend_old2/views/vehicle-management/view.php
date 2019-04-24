<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\VehicleManagement */

$this->title = $model->plate_number;
$this->params['breadcrumbs'][] = ['label' => 'Vehicle Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-management-view">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - TAARIFA ZA KUKODI GARI</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Taarifa Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Magari'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'tarehe_ya_kukodi',
            'mmiliki_wa_gari',
            'namba_ya_simu_mmiliki',
            'aina_ya_gari',
            'plate_number',
            'jina_la_dereva',
            'namba_ya_simu_dereva',
            [
                'attribute' => 'wilaya_id',
                'value' => $model->wilaya->jina
            ],
            'aliyeingiza',
            'muda',
        ],
    ]) ?>


    <div class="row">
        <div class="col-md-8">

        </div>
        <div class="col-md-4">
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
</div>
