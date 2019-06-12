<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\HamishaMzee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hamisha Mzees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hamisha-mzee-view">

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
            'mzee_id',
            'mkoa_anaokwenda',
            'wilaya_anayokwenda',
            'shehia_anayokwenda',
            'sababu',
            'mkoa_aliotoka',
            'wilaya_aliyotoka',
            'shehia_aliyotoka',
            'tarehe',
            'aliyeingiza',
            'muda',
        ],
    ]) ?>

</div>
