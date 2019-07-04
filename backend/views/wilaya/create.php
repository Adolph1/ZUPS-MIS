<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Wilaya */

$this->title = Yii::t('app', 'Wilaya Mpya');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wilaya'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wilaya-create">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - WILAYA</strong>
        </div>

        <div class="col-md-6">


            <?= Html::a(Yii::t('app', '<i class="fa fa-map-marker"></i> Wilaya Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Wilaya'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
