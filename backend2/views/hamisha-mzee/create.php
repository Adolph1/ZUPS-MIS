<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HamishaMzee */

$this->title = 'Hamisha Mzee';
$this->params['breadcrumbs'][] = ['label' => 'Wazee waliohamishwa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hamisha-mzee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
