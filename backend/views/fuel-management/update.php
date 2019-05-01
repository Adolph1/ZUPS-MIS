<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FuelManagement */

$this->title = 'Update Fuel Management: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fuel Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fuel-management-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
