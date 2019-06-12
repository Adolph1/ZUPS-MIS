<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MatumiziMengine */

$this->title = 'Create Matumizi Mengine';
$this->params['breadcrumbs'][] = ['label' => 'Matumizi Mengines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matumizi-mengine-create">

    <hr/>
    <div class="row">
        <div class="col-md-8">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - MALIPO YA MATUMIZI MBALIMBALI</strong>
        </div>
    </div>
    <hr/>

    <?= $this->render('_batch', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,'model' => $model
    ]) ?>

</div>
