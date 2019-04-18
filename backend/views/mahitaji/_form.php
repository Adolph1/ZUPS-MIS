<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Mahitaji */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mahitaji-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hitaji')->textInput(['maxlength' => true,'placeholder' => 'Ingiza hitaji jipya']) ?>
    <?= $form->field($model, 'aina_ya_hitaji')->dropDownList(['2' => 'Uendeshaji','1' => 'Ofisi'],['prompt' => '--Chagua--']) ?>
    <?= $form->field($model, 'category_id')->dropDownList(\backend\models\MahitajiCategory::getAll(),['prompt' => '--Chagua--']) ?>

    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
