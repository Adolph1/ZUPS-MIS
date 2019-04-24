<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KituoShehia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kituo-shehia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kituo_id')->dropDownList(\backend\models\Vituo::getAll(),['prompt' => '--Chagua--']) ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
