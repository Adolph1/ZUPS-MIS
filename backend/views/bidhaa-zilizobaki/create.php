<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BidhaaZilizobaki */

$this->title = 'Create Bidhaa Zilizobaki';
$this->params['breadcrumbs'][] = ['label' => 'Bidhaa Zilizobakis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidhaa-zilizobaki-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
