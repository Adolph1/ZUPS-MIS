<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GeneralLedger */

$this->title = 'General Ledger Form';
?>

<div class="row">
    <div class="col-md-10">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file-o"></i><strong> NEW ACCOUNT</strong></h3>
    </div>
    <div class="col-md-2 text-center">
        <?=  Html::a('Accounts List', ['index'], ['class' => 'btn btn-default text-green']) ?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
