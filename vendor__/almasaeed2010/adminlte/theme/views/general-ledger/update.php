<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GeneralLedger */

$this->title = 'General Ledger: ' . ' ' . $model->gl_description;
$this->params['breadcrumbs'][] = ['label' => 'General Ledgers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gl_description, 'url' => ['view', 'id' => $model->gl_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="general-ledger-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
