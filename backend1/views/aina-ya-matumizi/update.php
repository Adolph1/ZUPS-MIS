<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AinaYaMatumizi */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Aina Ya Matumizi',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aina Ya Matumizis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="aina-ya-matumizi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
