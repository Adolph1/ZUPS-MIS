<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Viambatanisho */

$this->title = Yii::t('app', 'Create Viambatanisho');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Viambatanishos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viambatanisho-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
