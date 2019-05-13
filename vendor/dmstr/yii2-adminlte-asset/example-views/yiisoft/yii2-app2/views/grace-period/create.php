<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GracePeriod */

$this->title = 'Create Grace Period';
$this->params['breadcrumbs'][] = ['label' => 'Grace Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grace-period-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
