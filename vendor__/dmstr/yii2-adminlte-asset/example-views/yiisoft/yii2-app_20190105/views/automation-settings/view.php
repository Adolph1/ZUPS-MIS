<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AutomationSettings */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Automation Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="automation-settings-view">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-gear"></i> ZUPS - AUTOMATION SETTINGS</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Setting mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya settings'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                    'attribute' => 'zone_id',
                    'value' => $model->zone->jina
            ],
            'malipo_kwanza',
            'malipo_ya_mwisho',
            'mwisho_kuaandaa_voucher',
            'muda_wa_voucher',

        ],
    ]) ?>

</div>
