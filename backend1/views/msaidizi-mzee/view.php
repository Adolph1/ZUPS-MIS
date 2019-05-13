<?php

use backend\models\MzeeSearch;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\widgets\DetailView;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\MsaidiziMzee */

$this->title = $model->jina_kamili;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mtu wa karibu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="loader1" style="display: none"></div>
<div id="msaidizi-id" style="display: none"><?= $model->id; ?></div>
<div class="msaidizi-mzee-view">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead" style="color: #01214d;font-family: Tahoma"> <i
                        class="fa fa-check-square text-green"></i> ZUPS - WATU WA KARIBU</strong>
        </div>

        <div class="col-md-6">


            <?= Html::a(Yii::t('app', '<i class="fa fa-user-plus"></i> Mtu wa karibu Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya watu wa karibu'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?php
            if ((Yii::$app->user->can('admin')) || (Yii::$app->user->can('PensionOfficer')) || Yii::$app->user->can('DataClerk')) { ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-pencil"></i>'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-original-title' => 'Fanya marekebisho',]) ?>
                <?php
            }
            ?>
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
                        'value' => function ($model) {
                            if ($model->jinsia == 'M') {
                                return 'MWANAUME';
                            } elseif ($model->jinsia == 'F') {
                                return 'MWANAMKE';
                            }
                        }
                    ],
                    //'picha',
                    'anuani',
                    'tarehe_kuzaliwa',
                    [
                        'attribute' => 'aina_ya_kitambulisho',
                        'value' => function ($model) {
                            if ($model->aina_ya_kitambulisho != 0) {
                                return $model->kitambulisho->jina;

                            } else {
                                return;
                            }
                        }
                    ],
                    'nambari_ya_kitambulisho',
                    [
                        'attribute' => 'uhusiano_id',
                        'value' => function ($model) {
                            if ($model->uhusiano_id != 0) {
                                return $model->uhusiano->jina;

                            } else {
                                return;
                            }
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            if ($model->status == \backend\models\MsaidiziMzee::ACTIVE) {
                                return 'ANARUHUSIWA';
                            } elseif ($model->status == \backend\models\MsaidiziMzee::INACTIVE) {
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
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="row">
                <?php
                if ($model->picha != null) {


                    $extension = explode(".", $model->picha);

                    if($extension[1] == 'PNG' || $extension[1] == 'png' || $extension[1] == 'jpg' || $extension[1] == 'jpeg') {

                        echo Html::img('uploads/wasaidizi/' . $model->picha,
                            ['width' => '150px', 'height' => '150px', 'class' => 'img-square']);

                    } else {
                        // ToDO with error: print_r($errors);
                        echo "<img src='data:image/png;base64,$model->picha', width='150px' height='150px' align='center' style='vertical-align: middle'/>";
                    }

                } else {
                    echo Html::img('uploads/wazee/avatar.jpg',
                        ['width' => '150px', 'height' => '150px', 'class' => 'img-square']);
                }
                ?>

            </div>

        </div>
    </div>

    <div class="panel panel-warning" style="background: #EEE">
        <div class="panel panel-heading">
            <a data-toggle="collapse" href="#collapse1"> Ingiza Mzee/Wazee wanaochukuliwa na mtu  wa karibu huyu</a>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
            <div class="panel panel-body" style="background: #EEE">
                <?php $form = ActiveForm::begin(['action' => ['msadizi-wazee-wengine/create']]); ?>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php
                                echo $form->field($wazee, 'mzee_id')->widget(Select2::classname(), [
                                    'data' => \backend\models\Mzee::getAllExcept($model->id, $model->wilaya_id),
                                    'language' => 'en',
                                    'options' => ['placeholder' => 'Chagua mzee ...', 'id' => 'search-form-id'],
                                    'pluginOptions' => [
                                        'allowClear' => false,

                                    ],
                                ])->label(false);


                                ?>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?= $form->field($wazee, 'msaidizi_id')->hiddenInput(['value' => $model->id])->label(false) ?>

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
                                ]) ?>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div id="confirm-mzee" style="display: none">

                                </div>
                            </div>
                            <div class="col-lg-6" id="mzee-to-confirm" style="display:none;">
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

</div>
<hr/>
<div class="row">
    <div class="col-md-6">
        <h4 class="text text-primary">Wazee wanachuokuliwa fedha na mtu wa karibu huyu</h4>
    </div>

</div>
<div class="row">
    <div class="col-xs-12">
        <?php
        $searchModel = new \backend\models\MsadiziWazeeWengineSearch();
        $dataProvider = $searchModel->searchByMsaidizId($model->id);
        echo \kartik\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'label' => 'Majina ya Mwanzo',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Html::a(Html::encode($data->mzee->majina_mwanzo), ['mzee/view', 'id' => $data->mzee_id]);
                    },
                ],
                [
                    'label' => 'Jina la Babu',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->mzee->jina_babu;
                    },
                ],


                [
                    // 'attribute' => 'id',
                    'label' => 'Power of attorney',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->power_of_attorney != null) {

                            $basepath = Yii::$app->request->baseUrl . '/uploads/power/' . $model->power_of_attorney;
                            //$path = str_replace($basepath, '', $model->attachment);
                            return Html::a('<i class="fa fa-file-pdf-o text-red"></i>', $basepath, array('target' => '_blank'));


                        } else {
                            return '';
                        }
                    }
                ],
                [
                    // 'attribute' => 'id',
                    'label' => 'Status',
                    'value' => function ($model) {
                        if ($model->status != null) {
                            if ($model->status == 1) {
                                return 'ANARUHUSIWA';
                            } else {
                                return 'AMESITISHWA';
                            }
                        } else {
                            return '';
                        }
                    }
                ],
                'valid_date',

                [
                    'class' => 'kartik\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {

                            $url = ['msadizi-wazee-wengine/disable-msaidizi', 'id' => $model->id];
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



