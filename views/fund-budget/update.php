<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FundBudget */

$this->title = 'Update Fund Budget: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fund Budgets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fund-budget-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
