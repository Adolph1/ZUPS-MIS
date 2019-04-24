<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BidhaaZilizobaki */

$this->title = 'Update Bidhaa Zilizobaki: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bidhaa Zilizobakis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bidhaa-zilizobaki-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
