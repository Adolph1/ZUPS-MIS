<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MsaidiziMzee */

$this->title = Yii::t('app', 'Mtu wa karibu Mpya');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wasaidizi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="msaidizi-mzee-create">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - WATU WA KARIBU</strong>
        </div>

        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-user-plus"></i> Mtu wa karibu Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Watu wa karibu'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
