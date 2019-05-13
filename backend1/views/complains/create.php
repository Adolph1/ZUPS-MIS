<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Complains */

$this->title = 'Create Complains';
$this->params['breadcrumbs'][] = ['label' => 'Complains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complains-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
