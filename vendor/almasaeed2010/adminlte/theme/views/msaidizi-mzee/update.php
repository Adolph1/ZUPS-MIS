<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MsaidiziMzee */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Msaidizi Mzee',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Msaidizi Mzees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="msaidizi-mzee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
