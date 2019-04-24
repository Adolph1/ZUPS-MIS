<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\KaziMzee */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Kazi Mzee',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kazi Mzees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="kazi-mzee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
