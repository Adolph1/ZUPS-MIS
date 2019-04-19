<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TransactionType */

$this->title = 'Create Transaction Type';
$this->params['breadcrumbs'][] = ['label' => 'Transaction Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
