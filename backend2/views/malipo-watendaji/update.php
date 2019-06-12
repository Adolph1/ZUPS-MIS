<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MalipoWatendaji */

$this->title = 'Update Malipo Watendaji: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Malipo Watendajis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="malipo-watendaji-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
