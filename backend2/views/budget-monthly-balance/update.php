<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BudgetMonthlyBalance */

$this->title = 'Update Budget Monthly Balance: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Budget Monthly Balances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="budget-monthly-balance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
