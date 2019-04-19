<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\FuelManagement */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fuel Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fuel-management-view">

    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - MGAWANYO WA MAFUTA</strong>
        </div>

        <div class="col-md-6">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Gawa Mafuta'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Magari yaliyopewa mafuta'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <hr/>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'vehicle_id',
            'kiasi_cha_mafuta',
            'tarehe',
            'dereva',
            'aliyeingiza',
            'muda',
        ],
    ]) ?>

</div>
