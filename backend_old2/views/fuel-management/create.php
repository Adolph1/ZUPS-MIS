<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FuelManagement */

$this->title = 'Mgawanyo wa mafuta';
$this->params['breadcrumbs'][] = ['label' => 'Fuel Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fuel-management-create">
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - MGAWANYO WA MAFUTA</strong>
        </div>

        <div class="col-md-6">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Gawa Mafuta'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Magari yaliyopewa mafuta'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
