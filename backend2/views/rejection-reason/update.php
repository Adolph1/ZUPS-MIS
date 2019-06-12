<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RejectionReason */

$this->title = 'Update Rejection Reason: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rejection Reasons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rejection-reason-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
