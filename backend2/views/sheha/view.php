<?php

use backend\models\ShehaMasaidiziSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Sheha */

$this->title = $model->jina_kamili;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shehas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sheha-view">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - TAARIFA ZA SHEHA </strong>
        </div>

        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-map-marker"></i> Sheha Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Masheha'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

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
           // 'id',
            'jina_kamili',
            'mtaa',
            'nyumba_namba',
            'jinsia',
            'simu',
            [
                    'attribute' => 'wilaya_id',
                    'value' => $model->wilaya->jina,
            ],
            'tarehe_kuzaliwa',
            //'shehia_id',
           // 'aliyeweka',
            //'muda',
        ],
    ]) ?>

</div>
