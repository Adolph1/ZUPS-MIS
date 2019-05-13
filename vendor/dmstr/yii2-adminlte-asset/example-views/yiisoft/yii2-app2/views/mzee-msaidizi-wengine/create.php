<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MzeeMsaidiziWengine */

$this->title = Yii::t('app', 'Create Mzee Msaidizi Wengine');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mzee Msaidizi Wengines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzee-msaidizi-wengine-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
