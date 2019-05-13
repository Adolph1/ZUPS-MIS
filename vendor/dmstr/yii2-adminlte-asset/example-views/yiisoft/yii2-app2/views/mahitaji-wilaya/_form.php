<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\MahitajiWilaya */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mahitaji-wilaya-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAll(),['prompt' => '--Chagua wilaya--']) ?>


    <?=  $form->field($model, 'mahitaji')->widget(Select2::classname(), [
        'data' => \backend\models\Mahitaji::getAll(),
        'language' => 'en',
        'options' => ['placeholder' => 'chagua mahitaji ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ]);
    ?>


    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
