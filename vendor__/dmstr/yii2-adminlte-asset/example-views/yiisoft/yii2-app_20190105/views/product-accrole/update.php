<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductAccrole */

$this->title = 'Update Product Accrole: ' . ' ' . $model->account_role;
$this->params['breadcrumbs'][] = ['label' => 'Product Accroles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->account_role, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-accrole-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
