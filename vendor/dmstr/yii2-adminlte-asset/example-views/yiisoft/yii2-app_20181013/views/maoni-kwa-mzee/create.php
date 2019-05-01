<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MaoniKwaMzee */

$this->title = Yii::t('app', 'Create Maoni Kwa Mzee');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Maoni Kwa Mzees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maoni-kwa-mzee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
