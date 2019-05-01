<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Teller */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Teller',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tellers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="teller-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
