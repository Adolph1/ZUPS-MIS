<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Accrole */

$this->title = 'Update Accrole: ' . ' ' . $model->role_code;
$this->params['breadcrumbs'][] = ['label' => 'Accroles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->role_code, 'url' => ['view', 'id' => $model->role_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accrole-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
