<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Mzee */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Mzee',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mzee'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mzee-update">

    <legend class="lead"><strong>Fomu ya usajili wa mzee</strong></legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
