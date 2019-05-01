<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Malipo */

$this->title = Yii::t('app', 'Create Malipo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Malipos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
