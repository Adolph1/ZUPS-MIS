<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProductEventEntry */

$this->title = 'Create Product Event Entry';
$this->params['breadcrumbs'][] = ['label' => 'Product Event Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-event-entry-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
