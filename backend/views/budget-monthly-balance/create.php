<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BudgetMonthlyBalance */

$this->title = 'Create Budget Monthly Balance';
$this->params['breadcrumbs'][] = ['label' => 'Budget Monthly Balances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-monthly-balance-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
