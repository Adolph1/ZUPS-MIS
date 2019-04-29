<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MiamalaWatendaji */

$this->title = 'Create Miamala Watendaji';
$this->params['breadcrumbs'][] = ['label' => 'Miamala Watendajis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="miamala-watendaji-create">

    <hr/>
    <div class="row">
        <div class="col-md-8">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - MIAMALA YA FEDHA ZA KUWALIPA WATENDAJI VITUONI</strong>
        </div>

        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-money"></i> Muamala Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Miamala'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
