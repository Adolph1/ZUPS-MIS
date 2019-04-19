<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RejectionReason */

$this->title = 'Create Rejection Reason';
$this->params['breadcrumbs'][] = ['label' => 'Rejection Reasons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rejection-reason-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
