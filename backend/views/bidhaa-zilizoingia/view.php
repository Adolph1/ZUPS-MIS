<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BidhaaZilizoingia */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bidhaa Zilizoingias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidhaa-zilizoingia-view">

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
            'tarehe_ya_kuingia',
            'bidhaa_id',
            'jina_aliyeleta',
            'idadi',
            'jumla',
            'aliyepokea',
            'aliyeingiza',
            'muda',
        ],
    ]) ?>

</div>
