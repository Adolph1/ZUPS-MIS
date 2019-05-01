<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KituoCashier */

$this->title = Yii::t('app', 'Create Kituo Cashier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kituo Cashiers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kituo-cashier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
