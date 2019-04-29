<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Marejesho */

$this->title = 'Create Marejesho';
$this->params['breadcrumbs'][] = ['label' => 'Marejeshos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marejesho-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
