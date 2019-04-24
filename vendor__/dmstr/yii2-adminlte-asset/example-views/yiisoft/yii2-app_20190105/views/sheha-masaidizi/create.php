<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ShehaMasaidizi */

$this->title = Yii::t('app', 'Create Sheha Masaidizi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sheha Masaidizis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sheha-masaidizi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
