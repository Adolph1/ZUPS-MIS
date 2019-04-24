<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GlCategory */

$this->title = 'Update Gl Category: ' . ' ' . $model->cate_id;
$this->params['breadcrumbs'][] = ['label' => 'Gl Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cate_id, 'url' => ['view', 'id' => $model->cate_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gl-category-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
