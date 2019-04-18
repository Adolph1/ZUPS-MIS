<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PensionNyingine */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pension Nyingine',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pension Nyingines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pension-nyingine-update">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - PENCHENI MPYA</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Pencheni Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Pencheni'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
