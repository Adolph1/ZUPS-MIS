<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Mkoa */

$this->title = Yii::t('app', 'Mkoa Mpya');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mkoas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mkoa-create">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - MKOA MPYA</strong>
        </div>
        <div class="col-md-3">

        </div>
        <div class="col-md-3">


            <?= Html::a(Yii::t('app', '<i class="fa fa-map-marker"></i> Mkoa Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Mikoa'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
