<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UploadedFiles */

$this->title = 'Update Uploaded Files: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Uploaded Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="uploaded-files-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
