<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MzeeMagonjwa */

$this->title = Yii::t('app', 'Create Mzee Magonjwa');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mzee Magonjwas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzee-magonjwa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
