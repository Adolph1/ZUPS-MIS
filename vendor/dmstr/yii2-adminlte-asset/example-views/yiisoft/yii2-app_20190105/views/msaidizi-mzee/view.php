<?php

use backend\models\MzeeSearch;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\form\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\MsaidiziMzee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Msaidizi Mzee'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="loader1" style="display: none"></div>
<div id="msaidizi-id" style="display: none"><?= $model->id;?></div>
<div class="msaidizi-mzee-view">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - TAARIFA ZA MSAIDIZI</strong>
        </div>
        <div class="col-md-3">

        </div>
        <div class="col-md-3">


            <?= Html::a(Yii::t('app', '<i class="fa fa-map-marker"></i> Msaidizi Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Wasaidizi'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
 <div class="row">
    <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
        <?php
        //$msaidizi = \backend\models\MsaidiziMzee::findOne(['mzee_id' => $model->id,'status' => \backend\models\MsaidiziMzee::ACTIVE]);

            echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'id',
                    'jina_kamili',
                    [
                        'attribute' => 'jinsia',
                        'value' => function ($model){
                            if($model->jinsia == 'M'){
                                return 'MWANAUME';
                            }elseif($model->jinsia == 'F'){
                                return 'MWANAMKE';
                            }
                        }
                    ],
                    //'picha',
                    'anuani',
                    'tarehe_kuzaliwa',
                    [
                        'attribute' => 'aina_ya_kitambulisho',
                        'value' => function($model){
                            if($model->aina_ya_kitambulisho != 0)
                            {
                                return $model->kitambulisho->jina;

                            }else{
                                return ;
                            }
                        }
                    ],
                    'nambari_ya_kitambulisho',
                    [
                        'attribute' => 'uhusiano_id',
                        'value' => function($model) {
                            if ($model->uhusiano_id != 0) {
                                return $model->uhusiano->jina;

                            } else {
                                return;
                            }
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model){
                            if($model->status == \backend\models\MsaidiziMzee::ACTIVE){
                                return 'ANARUHUSIWA';
                            }elseif($model->status == \backend\models\MsaidiziMzee::INACTIVE){
                                return 'AMESITISHWA';
                            }
                        }
                    ],
                    'aliyemuweka',
                    'muda',
                ],
            ]);

        ?>
    </div>
    <div  class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
        <?php
        if($model != null) {
            //echo $msaidizi->picha;
            ?>
            <div class="row">
                    <?php
                    if($model->picha !=null) {
                        echo Html::img('uploads/wasaidizi/' . $model->picha,
                            ['width' => '150px', 'height' => '150px', 'class' => 'img-square']);
                    }else{
                        echo Html::img('uploads/wazee/avatar.jpg',
                            ['width' => '150px', 'height' => '150px', 'class' => 'img-square']);
                    }
                    ?>
                    <br/><br/>
                    <p><b>Power of attorney: </b>
                        <?php
                        if($model->power_of_attorney == null){
                            echo '';
                        }
                        elseif($model->power_of_attorney!=null){


                            $basepath = Yii::$app->request->baseUrl.'/uploads/viambatanisho/'.$model->power_of_attorney;
                            //$path = str_replace($basepath, '', $model->attachment);
                            echo Html::a('<i class="fa fa-file-pdf-o text-red"></i>', $basepath, array('target'=>'_blank'));


                        }
                        ?>
                    </p>
                    <p><b>Mwisho wa power: <?= $model->tarehe_mwisho_power;?></b></p>
                    <?php
                    if($model->power_status == \backend\models\MsaidiziMzee::INACTIVE)
                    {
                        $status = 'Muda wake umekwisha';
                    }elseif($model->power_status == \backend\models\MsaidiziMzee::ACTIVE){
                        $status = 'Ipo sawa kwa matumizi';
                    }
                    ?>
                    <p><b>Power status: <?= $status;?></b></p>





            <?php
        }
        ?>

 </div>

</div>
 </div>
    <div class="row">
        <div class="col-md-6">
            <h4 class="text text-primary">Wazee wanachuokuliwa fedha na msaidizi huyu</h4>
        </div>

        <div class="col-md-4">
                <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <?=
                    $form->field($mzee, 'majina_mwanzo')->widget(Select2::classname(), [
                        'data' => \backend\models\Mzee::getAllExcept($model->id,$model->wilaya_id),
                        'language' => 'en',
                        'options' => ['placeholder' => 'Chagua mzee ...','id' => 'search-form-id'],
                        'pluginOptions' => [
                            'allowClear' => true,

                        ],
                    ])->label(false);
                    ?>


                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>

    </div>
    <hr/>
    <div class="row">
        <div class="col-xs-12">
            <?php
            $searchModel = new MzeeSearch();
            $dataProvider = $searchModel->searchByMsaidizId($model->id);
       echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'majina_mwanzo',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->majina_mwanzo),['mzee/view','id'=> $data->id]);
                },
            ],

            'jina_babu',
            'umri_sasa',
            [
                'attribute' => 'kituo_id',
                'value' => function ($model){
                    return $model->kituo->kituo;
                }
            ],
            [
                'attribute' => 'shehia_id',
                'value' => function ($model){
                    return $model->shehia->jina;
                }
            ],
            'nambar',

            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->statusLabel;
                }
            ],

            [
                'class'=>'kartik\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {

                            $url = ['mzee/disable-msaidizi', 'id' => $model->id];
                            return Html::a('<span class="fa fa-times"></span>', $url, [
                                'title' => 'Futa mzee',
                                'data-toggle' => 'tooltip', 'data-original-title' => 'Futa mzee',
                                'class' => 'btn btn-warning',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Unadhibitisha kumfuta mzee huyu ?'),
                                    'method' => 'post',

                                ],

                            ]);


                    },

                ]
            ],

            //['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-6">
        <div id="confirm-mzee" style="display: none">
           
        </div>
    </div>
    <div class="col-lg-6" id="mzee-to-confirm" style="display:none;">
        <?= Html::button('<i class="fa fa-check-square"></i> Kubali', ['class' => 'btn btn-warning','id' => 'confirm-mzee-id']) ?>
    </div>
    </div>

</div>
