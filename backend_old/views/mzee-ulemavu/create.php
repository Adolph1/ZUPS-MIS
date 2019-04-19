<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MzeeUlemavu */

$this->title = Yii::t('app', 'Create Mzee Ulemavu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mzee Ulemavus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzee-ulemavu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
