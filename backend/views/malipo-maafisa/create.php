<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\MalipoMaafisa */

$this->title = 'Create Malipo Maafisa';
$this->params['breadcrumbs'][] = ['label' => 'Malipo Maafisas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malipo-maafisa-create">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - MIAMALA YA MAAFISA</strong>
        </div>

        <div class="col-md-6">


            <?= Html::a(Yii::t('app', '<i class="fa fa-money"></i> Muamala Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>


                <?php
                Modal::begin([
                    'header' => '<h3 class="text text-primary">Fomu ya kupakia Miamala</h3>',
                    'toggleButton' => ['label' => ' <i class="fa fa-upload"></i> Pakia Miamala', 'class' => 'btn btn-success',],
                    'size' => Modal::SIZE_LARGE,
                    'options' => ['class' => 'slide', 'id' => 'modal-2'],
                ]);
                ?>
                <div class="maoni-kwa-mzee-form" style="margin-left: 10px">

                    <?php $form = ActiveForm::begin(['action' => ['uploaded-files/create'],'options'=>['enctype'=>'multipart/form-data']]); ?>

                    <?= $form->field($files,'file')->fileInput()->label(false);?>

                    <div class="form-group">


                        <?= Html::submitButton($files->isNewRecord ? Yii::t('app', 'Pakia') : Yii::t('app', 'Update'), ['class' => $files->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
                <?php
                Modal::end();
                ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Miamala'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>



        </div>
    </div>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
