<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MahesabuYaliofungwa */

$this->title = Yii::t('app', 'Create Mahesabu Yaliofungwa');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mahesabu Yaliofungwas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahesabu-yaliofungwa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
