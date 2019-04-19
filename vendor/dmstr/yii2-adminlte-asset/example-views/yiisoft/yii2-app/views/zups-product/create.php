<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ZupsProduct */

$this->title = Yii::t('app', 'Create Zups Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zups Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zups-product-create">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - SETTINGS MPYA</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> Settings Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Settings'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
