<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HamishaMzee */

$this->title = 'Update Hamisha Mzee: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hamisha Mzees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hamisha-mzee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
