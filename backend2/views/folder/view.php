<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Folder */

$this->title = $model->jina;
$this->params['breadcrumbs'][] = ['label' => 'Folders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-view">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - <i class="fa fa-folder-open text-yellow"></i><?= $model->jina;?></strong>
        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-file-o"></i> Folder Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Folders'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

            <?php
            Modal::begin([
            'header' => '<h3 class="text text-primary">Fomu ya kupakia files</h3>',
            'toggleButton' => ['label' => ' <i class="fa fa-upload"></i> Pakia files', 'class' => 'btn btn-success',],
            'size' => Modal::SIZE_LARGE,
            'options' => ['class' => 'slide', 'id' => 'modal-2'],
            ]);
            ?>
            <div class="maoni-kwa-mzee-form" style="margin-left: 10px">

                <?php $form = ActiveForm::begin(['action' => ['document/create'],'options'=>['enctype'=>'multipart/form-data']]); ?>

                <?= $form->field($document,'file')->fileInput()->label(false);?>
                <?= $form->field($document,'folder_id')->hiddenInput(['value' => $model->id])->label(false);?>

                <div class="form-group">


                    <?= Html::submitButton($document->isNewRecord ? Yii::t('app', 'Pakia') : Yii::t('app', 'Update'), ['class' => $document->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <?php
            Modal::end();
            ?>



        </div>
    </div>
    <hr/>


    <?php
    $files=\yii\helpers\FileHelper::findFiles('uploads/'.$model->jina);
    if (isset($files[0])) {
        foreach ($files as $index => $file) {
            $nameFicheiro = substr($file, strrpos($file, '/') + 1);

                echo Html::a($nameFicheiro, Url::base() . '/uploads/'.$model->jina.'/' . $nameFicheiro) . "<br/>" . "<br/>";

        }
    } else {
        echo "Hakuna file hata moja ya kupakua";
    }
    ?>

</div>
