<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KituoMonthlyBalances */

$this->title = Yii::t('app', 'Create Kituo Monthly Balances');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kituo Monthly Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kituo-monthly-balances-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
