<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = 'Update Product: ' . ' ' . $model->product_descption;
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <?= Html::a(Yii::t('app', '<i class="fa fa-money text-yellow"></i> NEW PRODUCT'), ['create'], ['class' => 'btn btn-default text-green']) ?>

        <?= Html::a(Yii::t('app', '<i class="fa fa-th text-yellow"></i> PRODUCT LIST'), ['index'], ['class' => 'btn btn-default text-green']) ?>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
