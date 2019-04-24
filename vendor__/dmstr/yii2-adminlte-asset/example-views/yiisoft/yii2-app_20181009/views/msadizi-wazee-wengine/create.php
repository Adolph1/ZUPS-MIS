<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MsadiziWazeeWengine */

$this->title = Yii::t('app', 'Create Msadizi Wazee Wengine');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Msadizi Wazee Wengines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="msadizi-wazee-wengine-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
