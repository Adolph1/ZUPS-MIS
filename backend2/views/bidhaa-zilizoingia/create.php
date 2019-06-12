<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BidhaaZilizoingia */

$this->title = 'Bidhaa Zinazoingia';
$this->params['breadcrumbs'][] = ['label' => 'Bidhaa Mpya', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<hr/>
<div class="row">
    <div class="col-md-6">
        <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - BIDHAA MPYA ZINAZOINGIA STORE</strong>
    </div>
    <div class="col-md-2">

    </div>

</div>
<hr/>
<div class="bidhaa-zilizoingia-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
