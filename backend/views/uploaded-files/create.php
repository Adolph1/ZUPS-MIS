<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UploadedFiles */

$this->title = 'Create Uploaded Files';
$this->params['breadcrumbs'][] = ['label' => 'Uploaded Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploaded-files-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
