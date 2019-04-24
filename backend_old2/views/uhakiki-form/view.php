<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UhakikiForm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Uhakiki Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uhakiki-form-view">

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
            'tarehe_ya_uhakiki',
            'aliyemhakiki',
            'mzee_id',
            'maoni_ya_uhakiki:ntext',
        ],
    ]) ?>

</div>
