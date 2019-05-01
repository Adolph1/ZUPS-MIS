<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WazeeWaliotenguliwa */

$this->title = 'Update Wazee Waliotenguliwa: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wazee Waliotenguliwas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wazee-waliotenguliwa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
