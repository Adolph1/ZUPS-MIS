<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductEventEntry */

$this->title = 'Update Product Event Entry: ' . ' ' . $model->product_code;
$this->params['breadcrumbs'][] = ['label' => 'Product Event Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_code, 'url' => ['view', 'id' => $model->product_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-event-entry-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
