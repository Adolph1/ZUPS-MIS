<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Accrole */

$this->title = $model->role_code;
$this->params['breadcrumbs'][] = ['label' => 'Accroles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accrole-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->role_code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->role_code], [
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
            'role_code',
            'role_description',
            'role_type',
            'module',
        ],
    ]) ?>

</div>
