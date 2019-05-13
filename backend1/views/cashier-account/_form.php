<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CashierAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cashier-account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cashier_id')->dropDownList(\backend\models\Teller::getCashiers(),['prompt' => '--Chagua Cashier--']) ?>

    <?= $form->field($model, 'account')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
