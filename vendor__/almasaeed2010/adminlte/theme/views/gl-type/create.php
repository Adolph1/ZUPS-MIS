<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GlType */

$this->title = 'Create Gl Type';
$this->params['breadcrumbs'][] = ['label' => 'Gl Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gl-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
