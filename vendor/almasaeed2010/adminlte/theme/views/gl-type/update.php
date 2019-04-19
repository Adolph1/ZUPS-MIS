<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GlType */

$this->title = 'Update Gl Type: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Gl Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gl-type-update">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
