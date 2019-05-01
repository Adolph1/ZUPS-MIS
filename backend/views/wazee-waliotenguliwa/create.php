<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WazeeWaliotenguliwa */

$this->title = 'Create Wazee Waliotenguliwa';
$this->params['breadcrumbs'][] = ['label' => 'Wazee Waliotenguliwas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wazee-waliotenguliwa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
