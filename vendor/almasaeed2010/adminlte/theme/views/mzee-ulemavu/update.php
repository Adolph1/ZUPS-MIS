<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MzeeUlemavu */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Mzee Ulemavu',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mzee Ulemavus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mzee-ulemavu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
