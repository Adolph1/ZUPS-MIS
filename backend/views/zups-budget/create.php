<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ZupsBudget */

$this->title = 'Create Zups Budget';
$this->params['breadcrumbs'][] = ['label' => 'Zups Budgets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zups-budget-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
