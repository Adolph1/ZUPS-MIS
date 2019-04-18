<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GlDailyBalance */

$this->title = Yii::t('app', 'Create Gl Daily Balance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gl Daily Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gl-daily-balance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
