<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Mzee */

$this->title = $model->majina_mwanzo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wazee'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<hr/>
<div class="row bg-info" style="padding: 10px">
    <div class="col-md-3">
        <h4><b>Jina la mzee:</b> <?= $this->title;?></h4>
    </div>
    <div class="col-md-3">
        <h4><b>Kitambulisho - ID : </b> <?= $model->nambar;?></h4>
    </div>
    <div class="col-md-3">
        <?php
        if($model->anaishi != \backend\models\Mzee::DIED) {
            ?>
            <h4>Status: <?= $model->statusLabel; ?></h4>
            <?php
        }else{
            echo '<h4>Status: Amefariki</h4>';
        }
        ?>
    </div>
    <div class="col-md-3">
        <?php
        if(($model->status == \backend\models\Mzee::PENDING && Yii::$app->user->can('vetBeneficiary')) || ($model->status == \backend\models\Mzee::PENDING && Yii::$app->user->can('admin'))) {



            Modal::begin([
                'header' => '<h3 class="text text-primary">Fomu ya kuingiza taarifa za uhakiki wa mzee</h3>',
                'toggleButton' => ['label' => ' <i class="fa fa-check-circle"></i> Hakiki', 'class' => 'btn btn-warning', ],
                'size' => Modal::SIZE_DEFAULT,
                'options' => ['class' => 'slide', 'id' => 'modal-4'],
            ]);
            ?>
            <div class="uhakiki-form-form" style="margin-left: 10px">

                <?php $form = ActiveForm::begin(['action' => ['uhakiki-form/create']]); ?>

                <?= $form->field($uhakiki, 'tarehe_ya_uhakiki')->widget(
                    DatePicker::className(), [
                    // inline too, not bad
                    'inline' => false,
                    // modify template for custom rendering
                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',

                    ],
                    'options'=>['placeholder'=>'Enter start date','value' => date('Y-m-d')]
                ]);?>

                <?= $form->field($uhakiki, 'aliyemhakiki')->textInput(['maxlength' => true]) ?>

                <?= $form->field($uhakiki, 'mzee_id')->hiddenInput(['value' => $model->id])->label(false) ?>

                <?= $form->field($uhakiki, 'maoni_ya_uhakiki')->textarea(['rows' => 6]) ?>
                <div class="row" style="margin-bottom: 10px">
                <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                    <?= Html::submitButton($uhakiki->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $uhakiki->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                </div>
                </div>
                </div>


                <?php ActiveForm::end(); ?>

            </div>
            <?php
            Modal::end();





            Modal::begin([
                'header' => '<h3 class="text text-primary">Sababu za kukataa ombi la mzee</h3>',
                'toggleButton' => ['label' => ' <i class="fa fa-times-circle"></i> Kataa Ombi', 'class' => 'btn btn-danger',
                    'data-original-title'=>"Add New"],
                'size' => Modal::SIZE_LARGE,

                'options' => ['class' => 'slide', 'id' => 'modal-2',],
            ]);
            ?>
            <div class="maoni-kwa-mzee-form" style="margin-left: 10px">

                <?php $form = ActiveForm::begin(['action' => ['maoni-kwa-mzee/create']]); ?>

                <?= $form->field($sababu, 'mzee_id')->hiddenInput(['value' => $model->id])->label(false) ?>

                <?= $form->field($sababu, 'sababu')->textarea(['rows' => 6]) ?>


                <div class="form-group">


                        <?= Html::submitButton($sababu->isNewRecord ? Yii::t('app', 'Kataa Ombi') : Yii::t('app', 'Update'), ['class' => $sababu->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                    </div>

                <?php ActiveForm::end(); ?>

            </div>
            <?php
            Modal::end();

        }elseif(($model->status == \backend\models\Mzee::ELIGIBLE && Yii::$app->user->can('suspendBeneficiary')) || ($model->status == \backend\models\Mzee::ELIGIBLE && Yii::$app->user->can('admin'))) {
            Modal::begin([
                'header' => '<h3 class="text text-primary">Sababu za Kusitisha huduma kwa mzee</h3>',
                'toggleButton' => ['label' => ' <i class="fa fa-times-circle"></i> Sitisha', 'class' => 'btn btn-danger', 'data-placement'=>"top" , ],
                'size' => Modal::SIZE_LARGE,
                'options' => ['class' => 'slide', 'id' => 'modal-2'],
            ]);
            ?>
            <div class="maoni-kwa-mzee-form" style="margin-left: 10px">

                <?php $form = ActiveForm::begin(['action' => ['maoni-kwa-mzee/create']]); ?>

                <?= $form->field($sababu, 'mzee_id')->hiddenInput(['value' => $model->id])->label(false) ?>

                <?= $form->field($sababu, 'sababu')->textarea(['rows' => 6]) ?>


                <div class="form-group">


                    <?= Html::submitButton($sababu->isNewRecord ? Yii::t('app', 'Sitisha huduma') : Yii::t('app', 'Update'), ['class' => $sababu->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <?php
            Modal::end();
        }elseif(($model->status == \backend\models\Mzee::REJECTED && Yii::$app->user->can('approveBeneficiary')) || ($model->status == \backend\models\Mzee::REJECTED && Yii::$app->user->can('admin')) ) {
            echo Html::a(Yii::t('app', '<i class="fa fa-check-square"></i>  Kubali'), ['confirm', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => Yii::t('app', 'Unathibitisha uhakiki wa mzee huyu?'),
                    'method' => 'post',

                ],
            ]);
        }elseif(($model->status == \backend\models\Mzee::VETTED && Yii::$app->user->can('approveBeneficiary')) || ($model->status == \backend\models\Mzee::VETTED && Yii::$app->user->can('admin'))){
            echo Html::a(Yii::t('app', '<i class="fa fa-check-square"></i>  Kubali'), ['approve', 'id' => $model->id], [
                'class' => 'btn btn-success', 'data-toggle' => 'tooltip', 'data-original-title' => 'Kubali Ombi la mzee',
                'data' => [
                    'confirm' => Yii::t('app', 'Unakubali Ombi la huyu mzee?'),
                    'method' => 'post',

                ],
            ]);

            Modal::begin([
                'header' => '<h3 class="text text-primary">Sababu za kukataa ombi la mzee</h3>',
                'toggleButton' => ['label' => ' <i class="fa fa-times-circle"></i> Kataa', 'class' => 'btn btn-danger',],
                'size' => Modal::SIZE_LARGE,
                'options' => ['class' => 'slide', 'id' => 'modal-2'],
            ]);
            ?>
            <div class="maoni-kwa-mzee-form" style="margin-left: 10px">

                <?php $form = ActiveForm::begin(['action' => ['maoni-kwa-mzee/create']]); ?>

                <?= $form->field($sababu, 'mzee_id')->hiddenInput(['value' => $model->id])->label(false) ?>

                <?= $form->field($sababu, 'sababu')->textarea(['rows' => 6]) ?>


                <div class="form-group">


                    <?= Html::submitButton($sababu->isNewRecord ? Yii::t('app', 'Kataa Ombi') : Yii::t('app', 'Update'), ['class' => $sababu->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <?php
            Modal::end();
        }

        ?>



