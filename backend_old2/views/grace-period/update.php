<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GracePeriod */

$this->title = 'Update Grace Period: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Grace Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grace-period-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
