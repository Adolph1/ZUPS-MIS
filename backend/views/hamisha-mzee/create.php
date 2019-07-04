<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HamishaMzee */

$this->title = 'Hamisha Mzee';
$this->params['breadcrumbs'][] = ['label' => 'Wazee waliohamishwa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hamisha-mzee-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
