<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ZupsProduct */

$this->title = $model->product_code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zups Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zups-product-view">



    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - TAARIFA ZA PRODUCT</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> Product Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Products'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

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
          //  'id',
            'product_code',
            'miaka',
            'kiasi',
            'maelezo',
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status == \backend\models\ZupsProduct::ACTIVE){
                        return "ACTIVE";
                    }elseif ($model->status == \backend\models\ZupsProduct::INACTIVE){
                        return 'INACTIVE';
                    }
                }
            ],
            'aliyeweka',
            'muda',
        ],
    ]) ?>

</div>
