<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Audit */

$this->title = Yii::t('app', 'Create Audit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Audits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
