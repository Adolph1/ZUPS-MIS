<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ZupsBudgetApproval */

$this->title = 'Create Zups Budget Approval';
$this->params['breadcrumbs'][] = ['label' => 'Zups Budget Approvals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zups-budget-approval-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
