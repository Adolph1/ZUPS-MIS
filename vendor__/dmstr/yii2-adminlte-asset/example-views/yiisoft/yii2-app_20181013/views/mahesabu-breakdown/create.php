<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MahesabuBreakdown */

$this->title = Yii::t('app', 'Create Mahesabu Breakdown');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mahesabu Breakdowns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahesabu-breakdown-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
