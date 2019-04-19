<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MzeeVipato */

$this->title = Yii::t('app', 'Create Mzee Vipato');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mzee Vipatos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzee-vipato-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
