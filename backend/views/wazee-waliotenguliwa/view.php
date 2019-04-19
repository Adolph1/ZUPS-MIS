<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\WazeeWaliotenguliwa */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wazee Waliotenguliwas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="wazee-waliotenguliwa-view">

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
           // 'id',
           [
                   'attribute' => 'mzee_id',
                    'value' => $model->mzee->majina_mwanzo. ' ' .$model->mzee->jina_babu,

           ]
            ,
            'sababu',
            'aliyeingiza',
            'muda',
        ],
    ]) ?>

</div>
