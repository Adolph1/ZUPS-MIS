<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KituoBalance */

$this->title = Yii::t('app', 'Create Kituo Balance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kituo Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kituo-balance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
