<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Accrole */

$this->title = 'New Account role';
$this->params['breadcrumbs'][] = ['label' => 'Accroles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accrole-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
