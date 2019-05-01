<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MiamalaWatendaji */

$this->title = 'Update Miamala Watendaji: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Miamala Watendajis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="miamala-watendaji-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
