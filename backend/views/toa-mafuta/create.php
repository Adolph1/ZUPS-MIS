<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ToaMafuta */

$this->title = '
Toa Mafuta';
$this->params['breadcrumbs'][] = ['label' => 'Toa Mafutas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toa-mafuta-create">

    <hr/>

    <?= $this->render('_form', [
        'model' => $model,'gar' => $gar
    ]) ?>

</div>
