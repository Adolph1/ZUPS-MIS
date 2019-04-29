<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BidhaaZilizoingia */

$this->title = 'Update Bidhaa Zilizoingia: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bidhaa Zilizoingias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bidhaa-zilizoingia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
