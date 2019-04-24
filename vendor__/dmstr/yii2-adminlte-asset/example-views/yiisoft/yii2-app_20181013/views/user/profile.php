<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */

?>
<div class="employee-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_profile', [
        'model' => $model,'emp'=>$emp,
    ]) ?>

</div>
