<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SmsOwner */

$this->title = Yii::t('app', 'Create Sms Owner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sms Owners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-owner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
