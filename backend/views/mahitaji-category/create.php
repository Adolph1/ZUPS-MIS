<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MahitajiCategory */

$this->title = 'Create Mahitaji Category';
$this->params['breadcrumbs'][] = ['label' => 'Mahitaji Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahitaji-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
