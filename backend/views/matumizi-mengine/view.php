<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MatumiziMengine */

$this->title = $model->malezo;
$this->params['breadcrumbs'][] = ['label' => 'Matumizi Mengines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matumizi-mengine-view">

    <hr/>
    <div class="row">
        <div class="col-md-8">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - MATUMIZI MBALIMBALI</strong>
        </div>

        <div class="col-md-4">
            <?= Html::a(Yii::t('app', '<i class="fa fa-money"></i> Muamala Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Miamala'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kumbukumbu_no',
            'tarehe',
            [
                    'attribute' => 'aina_ya_matumizi',
                    'value' => $model->aina->hitaji,
            ],
            'idadi',
            'kiasi',
            [
                    'attribute' => 'stakabadhi',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->stakabadhi != null) {
                            $basepath = Yii::$app->request->baseUrl . '/uploads/receipts/' . $model->stakabadhi;
                            //$path = str_replace($basepath, '', $model->attachment);
                            return Html::a('<i class="fa fa-file text-green"></i>', $basepath, array('target' => '_blank'));
                        }
                    },
            ],

            [
                'attribute' => 'suppler_id',
                'value' => function ($model){
                        if($model->supplier_id != null){
                            return $model->supplier->jina;
                        }else{
                            return '';
                        }
                }
            ],

            'malezo',
            'aliyeweka',
            'muda',
            [
                'attribute' => 'status',
                'value' => function ($model){
                    if($model->status == 'R'){
                        return 'Reversal';
                    }else{
                        return '';
                    }
                }
            ],

        ],
    ]) ?>

</div>
<div class="row">
    <div class="col-md-12">
        <div style="float: right">
            <p style="float: right;">
                <?php
                if($model->status != 'R') {
                    echo Html::a(Yii::t('app', 'Reverse'), ['reverse', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Unauhakika unataka ku-reverse muamala huu?'),
                            'method' => 'post',
                        ],
                    ]);
                }?>
            </p>
        </div>
    </div>
</div>
