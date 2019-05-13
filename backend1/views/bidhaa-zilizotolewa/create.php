<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BidhaaZilizotolewa */

$this->title = 'Toa Bidhaa';
$this->params['breadcrumbs'][] = ['label' => 'Bidhaa Zilizotolewas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidhaa-zilizotolewa-create">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-circle"></i> ZUPS - TOA BIDHAA</strong>
        </div>

        <div class="col-md-6">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Toa bidhaa'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya bidhaa zilizotolewa'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
