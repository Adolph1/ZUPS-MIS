<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProductAccrole */

$this->title = 'Create Product Accrole';
$this->params['breadcrumbs'][] = ['label' => 'Product Accroles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-accrole-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
