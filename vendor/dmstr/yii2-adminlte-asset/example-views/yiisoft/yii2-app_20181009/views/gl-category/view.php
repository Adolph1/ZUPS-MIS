<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\GlCategory */

$this->title = $model->category_name;
$this->params['breadcrumbs'][] = ['label' => 'Gl Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gl-category-view">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->cate_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->cate_id], [
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
            'cate_id',
            'category_description',
            'category_name',
            'maker_id',
            'maker_stamptime',
            'checker_id',
            'checker_stamptime',
        ],
    ]) ?>

</div>
