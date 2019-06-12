<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ZupsBudgetApproval */

$this->title = 'Update Zups Budget Approval: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Zups Budget Approvals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zups-budget-approval-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
