<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GharamaMahitaji */

$this->title = Yii::t('app', 'Create Gharama Mahitaji');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gharama Mahitajis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gharama-mahitaji-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
