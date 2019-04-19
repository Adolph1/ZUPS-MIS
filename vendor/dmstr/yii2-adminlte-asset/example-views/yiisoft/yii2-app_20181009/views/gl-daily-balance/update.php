<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GlDailyBalance */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Gl Daily Balance',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gl Daily Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="gl-daily-balance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
