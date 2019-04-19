<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TodayEntry */

$this->title = 'Create Today Entry';
$this->params['breadcrumbs'][] = ['label' => 'Today Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="today-entry-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
