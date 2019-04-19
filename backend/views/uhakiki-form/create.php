<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UhakikiForm */

$this->title = 'Create Uhakiki Form';
$this->params['breadcrumbs'][] = ['label' => 'Uhakiki Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uhakiki-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
