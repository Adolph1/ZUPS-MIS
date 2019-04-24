<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ClerkKituo */

$this->title = Yii::t('app', 'Create Clerk Kituo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clerk Kituos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clerk-kituo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
