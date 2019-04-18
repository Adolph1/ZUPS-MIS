<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Mahitaji */

$this->title = Yii::t('app', 'Create Mahitaji');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mahitajis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahitaji-create">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - HITAJI JIPYA</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file"></i> Hitaji Jipya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Mahitaji'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
