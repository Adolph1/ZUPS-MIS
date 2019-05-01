<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MzeeVipato */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Mzee Vipato',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mzee Vipatos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mzee-vipato-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
