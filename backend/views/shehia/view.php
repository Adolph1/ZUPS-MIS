<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Shehia */

$this->title = $model->jina;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shehias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shehia-view">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - TAARIFA ZA SHEHIA</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-map-marker"></i> Shehia Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Shehia'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'jina',
            [
                    'attribute' => 'wilaya_id',
                    'value' => $model->wilaya->jina,
            ],

            'aliyeweka',
            'muda',
        ],
    ]) ?>

</div>
