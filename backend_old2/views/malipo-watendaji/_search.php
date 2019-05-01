<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MalipoWatendajiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="malipo-watendaji-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'muamala_id') ?>

    <?= $form->field($model, 'tarehe_ya_kulipwa') ?>

    <?= $form->field($model, 'jina_kamili') ?>

    <?= $form->field($model, 'kiasi_alichopewa') ?>

    <?php // echo $form->field($model, 'kazi_yake') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
