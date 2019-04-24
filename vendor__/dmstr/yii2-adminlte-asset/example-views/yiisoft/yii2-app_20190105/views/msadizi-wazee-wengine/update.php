<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MsadiziWazeeWengine */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Msadizi Wazee Wengine',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Msadizi Wazee Wengines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="msadizi-wazee-wengine-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
