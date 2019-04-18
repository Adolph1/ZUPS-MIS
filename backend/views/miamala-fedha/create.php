<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MiamalaFedha */

$this->title = Yii::t('app', 'Muamala Mpya');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Miamala Fedhas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="miamala-fedha-create">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - MIAMALA YOTE YA KIFEDHA</strong>
        </div>

        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-map-marker"></i> Muamala Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Miamala'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
