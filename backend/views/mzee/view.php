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


        <?php
        if(($model->anaishi != \backend\models\Mzee::DIED && $model->status == \backend\models\Mzee::PENDING  && Yii::$app->user->can('updateBeneficiary')) ||($model->anaishi != \backend\models\Mzee::DIED &&  Yii::$app->user->can('admin')) ) { ?>

            <?= Html::a(Yii::t('app', '<i class="fa fa-pencil"></i>'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'data-toggle'=>"tooltip", 'rel'=>"tooltip",'title'=>"Fanya marekebisho",]) ?>
            <?php
        }
        elseif ($model->anaishi ==\backend\models\Mzee::DIED && Yii::$app->user->can('restoreBeneficiary')  || $model->anaishi == \backend\models\Mzee::DIED && Yii::$app->user->can('admin') )
            {

            Modal::begin([
                'header' => '<h3 class="text text-primary">Sababu za kutengua taarifa za kifo</h3>',
                'toggleButton' => ['label' => ' <i class="fa fa-times-circle"></i> Tengua', 'class' => 'btn btn-warning',
                    'data-original-title'=>"Add New"],
                'size' => Modal::SIZE_LARGE,

                'options' => ['class' => 'slide', 'id' => 'modal-5',],
            ]);
            ?>
            <div class="maoni-kwa-mzee-form" style="margin-left: 10px">

                <?php $form = ActiveForm::begin(['action' => ['wazee-waliotenguliwa/create']]); ?>

                <?= $form->field($restore, 'mzee_id')->hiddenInput(['value' => $model->id])->label(false) ?>

                <?= $form->field($restore, 'sababu')->textarea(['rows' => 6]) ?>


                <div class="form-group">


                    <?= Html::submitButton($restore->isNewRecord ? Yii::t('app', 'Tengua Taarifa') : Yii::t('app', 'Update'), ['class' => $restore->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <?php
            Modal::end();

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
                 'options' => ['id' => 'tab1'],
            ],

            [
                'label' => 'Viambatanisho',
               'content' => $this->render('viambatanisho',['model' => $model,'kiambatanisho'=>$kiambatanisho]),
                //'active' => $model->app_tab==\backend\models\Application::PROCEDURE,
                'headerOptions' => ['style'=>'font-weight:bold'],
                'options' => ['id' => 'tab2'],
            ],
            [
                'label' => 'wazee anaowachukulia',
                //'visible' =>  Yii::$app->user->can(''),
                'content' => $this->render('wazee_wengine',['model' => $model,'wazee' => $wazee]),
                //'active' => $model->app_tab==\backend\models\Application::CHARGES,
                'headerOptions' => ['style'=>'font-weight:bold'],
                //'options' => ['id' => 'myveryownID'],
                'options' => ['id' => 'tab3'],
            ],
            [
                'label' => 'Maoni ya Afisa Wilaya',
                 'content' => $model->maoni_ofisi_wilaya,
                //'active' => $model->app_tab==\backend\models\Application::CHARGES,
                'headerOptions' => ['style'=>'font-weight:bold'],
                'options' => ['id' => 'tab5'],
            ],

            [
                'label' => 'Malipo ya mzee',
                'content' => $this->render('malipo_ya_mzee',['model' => $model]),
                'headerOptions' => ['style'=>'font-weight:bold'],
                'options' => ['id' => 'tab6'],
                //'active' => $model->app_tab==\backend\models\Application::PREVIEW,
            ],
            [
                'label' => 'Maoni ya uhakiki',
                'content' => $this->render('maoni_ya_uhakiki',['model' => $model]),
                //'active' => $model->app_tab==\backend\models\Application::CHARGES,
                'headerOptions' => ['style'=>'font-weight:bold'],
                'options' => ['id' => 'tab7'],
            ],
            [
                'label' => 'Maoni mengine',
                'content' => $this->render('maoni_kwa_mzee',['model' => $model]),
                //'active' => $model->app_tab==\backend\models\Application::CHARGES,
                'headerOptions' => ['style'=>'font-weight:bold'],
                'options' => ['id' => 'tab8'],
            ],
            [
                'label' => 'Taarifa za mtu wa karibu',
                'content' => $this->render('mtu_karibu',['model' => $model,'msaidiz'=> $msaidiz]),
                //'active' => $model->app_tab==\backend\models\Application::CHARGES,
                'headerOptions' => ['style'=>'font-weight:bold'],
                'options' => ['id' => 'tab9'],
            ],


            /*   [
               'label' => 'wazee anaowachukulia fedha',
               'content' => $this->render('wazee_wengine',['model' => $model,'wazee' => $wazee]),
               //'active' => $model->app_tab==\backend\models\Application::CHARGES,
               'headerOptions' => ['style'=>'font-weight:bold'],
               //'options' => ['id' => 'myveryownID'],
           ],
        */








        ],


    ]);
    ?>



</div>
