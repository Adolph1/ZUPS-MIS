<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ViambatanishoMzee */

$this->title = Yii::t('app', 'Create Viambatanisho Mzee');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Viambatanisho Mzees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viambatanisho-mzee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
