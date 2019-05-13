<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GharamaMahitaji */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Gharama Mahitaji',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gharama Mahitajis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="gharama-mahitaji-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
