<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MalipoWatendaji */

$this->title = 'Malipo Watendaji';
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malipo-watendaji-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
