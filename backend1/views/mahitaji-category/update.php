<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MahitajiCategory */

$this->title = 'Update Mahitaji Category: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mahitaji Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mahitaji-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
