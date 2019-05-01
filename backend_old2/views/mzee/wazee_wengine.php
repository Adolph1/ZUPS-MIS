<?php

use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div id="loader1" style="display: none"></div>
<div class="row">
    <?php
if($model->status != \backend\models\Mzee::REJECTED){
    ?>
        <div class="panel panel-warning"  style="background: #EEE">
            <div class="panel panel-heading">
                <a data-toggle="collapse" href="#collapse1"> Ingiza mzee mwingine</a>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <div class="panel panel-body" style="background: #EEE">
                    <?php $form = ActiveForm::begin(['action' => ['mzee-msaidizi-wengine/create']]); ?>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?php
                                    echo $form->field($wazee, 'mzee_mwingine_id')->widget(Select2::classname(), [
                                        'data' => \backend\models\Mzee::getAllExcept($model->id,$model->wilaya_id),
                                        'language' => 'en',
                                        'options' => ['placeholder' => 'Chagua mzee ...','id' => 'search-mzee-id'],
                                        'pluginOptions' => [
                                            'allowClear' => false,

                                        ],
                                    ])->label(false);


                                    ?>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?= $form->field($wazee, 'mzee_id')->hiddenInput(['value' => $model->id])->label(false) ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <?= $form->field($wazee, 'my_power')->fileInput() ?>

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <?= $form->field($wazee, 'valid_date')->widget(
                                        DatePicker::className(), [
                                        // inline too, not bad
                                        'inline' => false,
                                        // modify template for custom rendering
                                        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format' => 'yyyy-mm-dd',

                                        ],
                                        'options' => ['placeholder' => 'Tarehe ya mwisho wa power']
                                    ])?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="confirm-mzee-msaidizi" style="display: none">

                                    </div>
                                </div>
                                <div class="col-lg-6" id="mzee-to-confirm-msaidizi" style="display:none;">
                                    <?php // Html::button('<i class="fa fa-check-square"></i> Kubali', ['class' => 'btn btn-warning','id' => 'confirm-mzee-id']) ?>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px">
                                <div class="form-group">
                                    <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                                        <?= Html::submitButton($wazee->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $wazee->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                                    </div>
                                </div>
                            </div>



                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
}
 ?>
    <div class="row">
        <div class="col-md-6">
            <h4 class="text text-primary">Wazee wanachuokuliwa fedha na mzee huyu</h4>
        </div>

    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php
            $searchModel = new \backend\models\MzeeMsaidiziWengineSearch();
            $dataProvider = $searchModel->searchByMsaidizId($model->id);
            echo \kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label'=>'Jina Kamili',
                        'attribute' => 'mzee_mwingine_id',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a(Html::encode(\backend\models\Mzee::getFullname($data->mzee_mwingine_id)),['mzee/view','id'=> $data->mzee_mwingine_id]);
                        },
                    ],


                    [
                        // 'attribute' => 'id',
                        'label' => 'Power of attorney',
                        'format' => 'raw',
                        'value' => function ($model){
                            if($model->power_of_attorney != null) {

                                $basepath = Yii::$app->request->baseUrl.'/uploads/power/'.$model->power_of_attorney;
                                //$path = str_replace($basepath, '', $model->attachment);
                                return Html::a('<i class="fa fa-file-pdf-o text-red"></i>', $basepath, array('target'=>'_blank'));


                            }else{
                                return '';
                            }
                        }
                    ],
                    [
                        // 'attribute' => 'id',
                        'label' => 'Status',
                        'value' => function ($model){
                            if($model->status != null) {
                                if($model->status == 1){
                                    return 'ANARUHUSIWA';
                                }else{
                                    return 'AMESITISHWA';
                                }
                            }else{
                                return '';
                            }
                        }
                    ],
                    'valid_date',


                    [
                        'class'=>'kartik\grid\ActionColumn',
                        'header'=>'Actions',
                        'template'=>'{view}',
                        'buttons'=>[
                            'view' => function ($url, $model) {

                                $url = ['mzee-msaidizi-wengine/disable-msaidizi', 'id' => $model->id];
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


</div>
