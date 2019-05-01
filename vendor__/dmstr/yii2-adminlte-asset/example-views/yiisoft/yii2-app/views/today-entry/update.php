<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TodayEntry */

$this->title = 'Entry Reference: ' . ' ' . $model->trn_ref_no;
$this->params['breadcrumbs'][] = ['label' => 'Today Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="today-entry-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
