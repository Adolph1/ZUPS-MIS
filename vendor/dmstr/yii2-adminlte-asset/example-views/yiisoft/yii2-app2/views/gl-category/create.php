<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GlCategory */

$this->title = 'Create Gl Category';
$this->params['breadcrumbs'][] = ['label' => 'Gl Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gl-category-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
