<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Event Type',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="event-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
