<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OfficeSupervisor */

$this->title = Yii::t('app', 'Create Office Supervisor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Office Supervisors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="office-supervisor-create">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - AINA MPYA YA MATUMIZI</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Matumizi Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Matumizi'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
