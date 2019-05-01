<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

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
        <h4>Status: <?= $model->statusLabel;?></h4>
    </div>
    <div class="col-md-3">
        <?php
        if($model->status == \backend\models\Mzee::PENDING) {
           echo Html::a(Yii::t('app', '<i class="fa fa-check-square"></i>  '), ['confirm', 'id' => $model->id], [
                'class' => 'btn btn-warning', 'data-toggle' => 'tooltip', 'data-original-title' => 'Thibitisha uhakiki',
                'data' => [
                    'confirm' => Yii::t('app', 'Unadhibitisha uhakiki wa huyu mzee?'),
                    'method' => 'post',

                ],
            ]);




            Modal::begin([
                'header' => '<h3 class="text text-primary">Sababu za kukataa ombi la mzee</h3>',
                'toggleButton' => ['label' => ' <i class="fa fa-times-circle"></i>', 'class' => 'btn btn-danger',],
                'size' => Modal::SIZE_LARGE,
                'options' => ['class' => 'slide', 'id' => 'modal-2'],
            ]);
            ?>
            <div class="maoni-kwa-mzee-form">

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

        }elseif($model->status == \backend\models\Mzee::ELIGIBLE) {
            Modal::begin([
                'header' => '<h3 class="text text-primary">Sababu za Kusitisha huduma kwa mzee</h3>',
                'toggleButton' => ['label' => ' <i class="fa fa-times-circle"></i>', 'class' => 'btn btn-danger',],
                'size' => Modal::SIZE_LARGE,
                'options' => ['class' => 'slide', 'id' => 'modal-2'],
            ]);
            ?>
            <div class="maoni-kwa-mzee-form">

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
        }elseif($model->status == \backend\models\Mzee::REJECTED) {
            echo Html::a(Yii::t('app', '<i class="fa fa-check-square"></i>  '), ['confirm', 'id' => $model->id], [
                'class' => 'btn btn-success', 'data-toggle' => 'tooltip', 'data-original-title' => 'Thibitisha uhakiki',
                'data' => [
                    'confirm' => Yii::t('app', 'Unathibitisha uhakiki wa mzee huyu?'),
                    'method' => 'post',

                ],
            ]);
        }elseif($model->status == \backend\models\Mzee::VETTED){
            echo Html::a(Yii::t('app', '<i class="fa fa-check-square"></i>  '), ['approve', 'id' => $model->id], [
                'class' => 'btn btn-success', 'data-toggle' => 'tooltip', 'data-original-title' => 'Kubali Ombi la mzee',
                'data' => [
                    'confirm' => Yii::t('app', 'Unakubali Ombi la huyu mzee?'),
                    'method' => 'post',

                ],
            ]);

            Modal::begin([
                'header' => '<h3 class="text text-primary">Sababu za kukataa ombi la mzee</h3>',
                'toggleButton' => ['label' => ' <i class="fa fa-times-circle"></i>', 'class' => 'btn btn-danger',],
                'size' => Modal::SIZE_LARGE,
                'options' => ['class' => 'slide', 'id' => 'modal-2'],
            ]);
            ?>
            <div class="maoni-kwa-mzee-form">

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


        <?php
        if($model->anaishi != \backend\models\Mzee::DIED) { ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-pencil"></i>'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-original-title' => 'Fanya marekebisho',]) ?>
            <?php
        }
        ?>
    </div>
</div>
<hr/>
<div class="mzee-view">

    <?php
    echo \kartik\tabs\TabsX::widget([
        'position' => \kartik\tabs\TabsX::POS_ABOVE,
        'align' => \kartik\tabs\TabsX::ALIGN_LEFT,
        'items' => [
            [
                'label' => 'Taarifa za mzee',
                'content' => $this->render('taarifa_za_mzee',['model' => $model,]),
                'headerOptions' => ['style'=>'font-weight:bold'],
                //'active' => $model->app_tab==\backend\models\Application::ATTACHMENT,
                // 'options' => ['id' => 'myveryownID'],
            ],

            [
                'label' => 'Viambatanisho',
               'content' => $this->render('viambatanisho',['model' => $model,'kiambatanisho'=>$kiambatanisho]),
                //'active' => $model->app_tab==\backend\models\Application::PROCEDURE,
                'headerOptions' => ['style'=>'font-weight:bold'],
                //'options' => ['id' => 'myveryownID'],
            ],
            [
                'label' => 'Taarifa za mtu wa karibu',
                'content' => $this->render('mtu_karibu',['model' => $model,'msaidiz'=> $msaidiz]),
                //'active' => $model->app_tab==\backend\models\Application::CHARGES,
                'headerOptions' => ['style'=>'font-weight:bold'],
                //'options' => ['id' => 'myveryownID'],
            ],
            [
                'label' => 'Magonjwa, Ulemavu na Vipato',
                'content' => $this->render('magonjwa_ulemavu_vipato',['model' => $model,'msaidiz'=> $msaidiz]),
                //'active' => $model->app_tab==\backend\models\Application::CHARGES,
                'headerOptions' => ['style'=>'font-weight:bold'],
                //'options' => ['id' => 'myveryownID'],
            ],
            [
                'label' => 'Maoni ya Afisa Wilaya',
                 'content' => $model->maoni_ofisi_wilaya,
                //'active' => $model->app_tab==\backend\models\Application::CHARGES,
                'headerOptions' => ['style'=>'font-weight:bold'],
                //'options' => ['id' => 'myveryownID'],
            ],

            [
                'label' => 'Malipo ya mzee',
                'content' => $this->render('malipo_ya_mzee',['model' => $model,]),
                'headerOptions' => ['style'=>'font-weight:bold'],
                //'options' => ['id' => 'myveryownID'],
                //'active' => $model->app_tab==\backend\models\Application::PREVIEW,
            ],
            [
                'label' => 'Maoni mengine',
                'content' => $this->render('maoni_kwa_mzee',['model' => $model]),
                //'active' => $model->app_tab==\backend\models\Application::CHARGES,
                'headerOptions' => ['style'=>'font-weight:bold'],
                //'options' => ['id' => 'myveryownID'],
            ],








        ],


    ]);
    ?>


</div>
