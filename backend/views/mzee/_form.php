<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Mzee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mzee-form">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

            <?php $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data',
                    'enableAjaxValidation' => true,
                ]]); ?>
            <div class="row" style="margin-top: 10px">
                <div class="col-sm-12">
                    <legend class="lead text-blue"><strong>Taarifa za mzee</strong></legend>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'fomu_namba')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza namba ya fomu']) ?>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="input-group input-group-md">
                        <?= $form->field($model, 'zanzibar_id')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza namba ya kitambulisho cha uzanzibari'])->label('Zanzibar ID') ?>
                        <span class="input-group-btn">
                      <?= Html::button('Verify', ['class' => 'btn btn-info form-control', 'style' => 'margin-top:21.5px', 'id' => 'zenji-id']) ?>                    </span>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'mzee_picha')->fileInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'majina_mwanzo')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza majina ya mwanzo ya mzee']) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'jina_babu')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza jina la babu']) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'jina_maarufu')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza jina maarufu kama lipo']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'jinsia')->dropDownList(['M' => 'MWANAUME', 'F' => 'MWANAMKE'], ['prompt' => '--Chagua--']) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'tarehe_kuzaliwa')->widget(
                        DatePicker::className(), [
                        // inline too, not bad
                        'inline' => false,
                        'clientOptions' => [
                            'autoclose' => true,
                            'endDate' => date('Y-m-d', strtotime(' -50 year')),
                            'format' => 'yyyy-mm-dd',
                            'showOff' => 'button',

                        ],
                        'options' => ['placeholder' => 'Ingiza tarehe ya kuzaliwa', 'id' => 'tar-kuz-id', 'onblur' => 'jsCalculateYears(this)', 'onkeyup' => 'jsCalculateYears(this)'],
                    ]); ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'umri_kusajiliwa')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>

                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'umri_sasa')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'mzawa_zanzibar')->dropDownList(['Y' => 'NDIYO', 'N' => 'HAPANA'], ['prompt' => '--Chagua--']) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'aina_ya_kitambulisho')->dropDownList(\backend\models\AinaYaKitambulisho::getAll(), ['prompt' => '--Chagua--']) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'nambar', ['enableAjaxValidation' => true])->textInput(['autofocus' => true,]) ?>
                    <?php // $form->field($model, 'nambar')->textInput(['autofocus' => true, 'placeholder' => 'Ingiza nambari ya kitambulisho']) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'tarehe_kuingia_zanzibar')->widget(
                        DatePicker::className(), [
                        // inline too, not bad
                        'inline' => false,
                        // modify template for custom rendering
                        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',

                        ],
                        'options' => ['placeholder' => 'Ingiza tarehe ya kuingia zanzibar']
                    ]) ?>
                </div>
            </div>
            <?php
            if (Yii::$app->user->can('DataClerk')) {
                ?>
                <div id="loader1" style="display: none"></div>
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">

                        <?= $model->isNewRecord ? $form->field($model, 'mkoa_id')->dropDownList(\backend\models\Mkoa::getRegionBYUSerID(Yii::$app->user->identity->user_id), ['readonly' => 'readonly']) : $form->field($model, 'mkoa_id')->dropDownList(\backend\models\Mkoa::getRegionByID($model->mkoa_id), ['readonly' => 'readonly']) ?>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <?= $model->isNewRecord ? $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getDistrictBYUSerID(Yii::$app->user->identity->user_id), ['readonly' => 'readonly']) : $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getDistrictBYID($model->wilaya_id), ['readonly' => 'readonly']) ?>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'shehia_id')->dropDownList(\backend\models\Shehia::getShehiaBYUSerID(Yii::$app->user->identity->user_id), ['prompt' => '--Chagua Shehia--']) ?>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'mtaa')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza mtaa']) ?>
                    </div>
                </div>
                <?php
            } else {

                ?>
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">

                        <?= $form->field($model, 'mkoa_id')->dropDownList(\backend\models\Mkoa::getAll(), ['prompt' => '--Chagua mkoa--']) ?>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <?= $model->isNewRecord ? $form->field($model, 'wilaya_id')->dropDownList(['prompt' => '--Chagua Wilaya--']) : $form->field($model, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAllByRegionID($model->mkoa_id), ['prompt' => '--Chagua Wilaya--']) ?>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <div id="loader1" style="display: none"></div>
                        <?=
                        $model->isNewRecord ?
                            $form->field($model, 'shehia_id')->widget(Select2::classname(), [
                                // 'data' => '',
                                'language' => 'en',
                                'options' => ['placeholder' => 'Chagua shehia ...',],
                                'pluginOptions' => [
                                    'allowClear' => false
                                ],
                            ])
                            :
                            $form->field($model, 'shehia_id')->widget(Select2::classname(), [
                                'data' => \backend\models\Shehia::getAllByWilayaID($model->wilaya_id),
                                'language' => 'en',
                                'options' => ['placeholder' => 'Chagua shehia ...',],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>

                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'mtaa')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza mtaa']) ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'namba_nyumba')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza namba ya nyumba']) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'anuani_kamili_mtaa')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza anuani kamili ya mtaa']) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'anuani_ya_posta')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza anuani ya posta']) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'simu')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza namba ya simu']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">

                    <?= $form->field($model, 'kazi_id')->dropDownList(\backend\models\KaziMzee::getAll(), ['prompt' => '--Chagua kazi--']) ?>

                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'pension_nyingine')->dropDownList(['Y' => 'NDIYO', 'N' => 'HAPANA'], ['prompt' => '--Chagua--']) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'aina_ya_pension')->dropDownList(\backend\models\PensionNyingine::getAll(), ['prompt' => '--Chagua--']) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'zups_pension_type')->dropDownList(\backend\models\ZupsProduct::getAll(), ['prompt' => '--Chagua pencheni--']) ?>

                    <?php //$form->field($model, 'posho_wilaya')->checkbox(['class' => 'checkmark','style' => 'margin-top:25px;margin-left:30px']) ?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'njia_upokeaji')->dropDownList(\backend\models\NjiaMalipo::getAllTypes(), ['prompt' => '--Chagua--']) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'wanaomtegemea')->textInput() ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'blood_group_id')->dropDownList(\backend\models\BloodGroup::getAll(), ['prompt' => '--Chagua group--']) ?>
                </div>
            </div>
            <div id="malipo-benki-id" style="display: none">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'jina_bank')->textInput() ?>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'jina_account')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <?= $form->field($model, 'nambari_account')->textInput(['maxlength' => true]) ?>
                    </div>

                </div>
            </div>
            <div class="row" id="malipo-simu-id" style="display: none">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'simu_kupokelea')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-lg-6 col-md-6">
                    <?= $form->field($model, 'ulemavu')->widget(Select2::classname(), [
                        'data' => \backend\models\Ulemavu::getAll(),
                        'language' => 'en',
                        'options' => ['placeholder' => 'chagua ulemavu ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'multiple' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-sm-12 col-xs-12 col-lg-6 col-md-6">
                    <?= $model->isNewRecord ?
                        $form->field($model, 'magonjwa')->widget(Select2::classname(), [
                            'data' => \backend\models\Magonjwa::getAll(),
                            'language' => 'en',
                            'options' => ['placeholder' => 'chagua magonjwa ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => true
                            ],
                        ]) :
                        $form->field($model, 'magonjwa')->widget(Select2::classname(), [

                            'data' => \backend\models\Magonjwa::getAll(),
                            'maintainOrder' => true,
                            'language' => 'en',
                            'options' => ['placeholder' => 'chagua magonjwa ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => true
                            ],
                        ]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <?= $form->field($model, 'vipato')->widget(Select2::classname(), [
                        'data' => \backend\models\Vipato::getAll(),
                        'language' => 'en',
                        'options' => ['placeholder' => 'chagua vipato ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'multiple' => true
                        ],
                    ]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <?= $model->isNewRecord ? $form->field($model, 'mchukua_taarifa_id')->dropDownList(['prompt' => '--Chagua mchukua taarifa--']) : $form->field($model, 'mchukua_taarifa_id')->dropDownList(\backend\models\Sheha::getAll($model->shehia_id), ['prompt' => '--Chagua mchukua taarifa--']) ?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'maoni_ofisi_wilaya')->textarea(['rows' => 6]) ?>
                </div>
            </div>


        </div>
    </div>

</div>
<?= $form->field($model, 'mtu_wa_karibu')->checkbox(['id' => 'myCheck', 'onclick' => 'myFunction()']) ?>
<div class="msaidizi-mzee-form" style="display: none" id="text">

    <?php
    if ($model->isNewRecord) {
        ?>
        <div class="row" style="margin-top: 10px">
            <div class="col-sm-12">
                <legend class="lead text-blue"><strong>Taarifa za Mtu wa karibu</strong></legend>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($msaidizi, 'jina_kamili')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza jina kamili']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($msaidizi, 'jinsia')->dropDownList(['M' => 'MWANAUME', 'F' => 'MWANAMKE'], ['prompt' => '--Chagua--']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($msaidizi, 'anuani')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza anuani']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($msaidizi, 'simu')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza namba ya simu']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($msaidizi, 'aina_ya_kitambulisho')->dropDownList(\backend\models\AinaYaKitambulisho::getAll(), ['prompt' => '--Chagua--', 'id' => 'msaidiz-aina']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($msaidizi, 'nambari_ya_kitambulisho')->textInput(['maxlength' => true, 'placeholder' => 'Ingiza nambari ya kitambulisho']) ?>
            </div>
        </div>
        <div id="loader1" style="display: none"></div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($msaidizi, 'tarehe_kuzaliwa')->widget(
                    DatePicker::className(), [
                    // inline too, not bad
                    'inline' => false,
                    // modify template for custom rendering
                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'options' => ['placeholder' => 'Ingiza tarehe ya kuzaliwa', 'id' => 'kuzaliwa'],
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',

                    ],

                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($msaidizi, 'uhusiano_id')->dropDownList(\backend\models\Uhusiano::getAll(), ['prompt' => '--Chagua--']) ?>
            </div>
        </div>

        <?php
        if (Yii::$app->user->can('DataClerk')) {
            ?>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

                    <?= $msaidizi->isNewRecord ? $form->field($msaidizi, 'mkoa_id')->dropDownList(\backend\models\Mkoa::getRegionBYUSerID(Yii::$app->user->identity->user_id), ['readonly' => 'readonly']) : $form->field($msaidizi, 'mkoa_id')->dropDownList(\backend\models\Mkoa::getRegionByID($model->mkoa_id), ['readonly' => 'readonly']) ?>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <?= $msaidizi->isNewRecord ? $form->field($msaidizi, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getDistrictBYUSerID(Yii::$app->user->identity->user_id), ['readonly' => 'readonly']) : $form->field($msaidizi, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getDistrictBYID($model->wilaya_id), ['readonly' => 'readonly']) ?>
                </div>

            </div>
            <?php
        } else {

            ?>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

                    <?= $form->field($msaidizi, 'mkoa_id')->dropDownList(\backend\models\Mkoa::getAll(), ['prompt' => '--Chagua mkoa--']) ?>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <?= $msaidizi->isNewRecord ? $form->field($msaidizi, 'wilaya_id')->dropDownList(['prompt' => '--Chagua Wilaya--']) : $form->field($msaidizi, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAllByRegionID($msaidizi->mkoa_id), ['prompt' => '--Chagua Wilaya--']) ?>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($msaidizi, 'msaidizi_picha')->fileInput(['maxlength' => true]) ?>
            </div>

        </div>
        <?php
    }
    ?>


</div>

<div class="row" style="margin-bottom: 10px">
    <div class="form-group">
        <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '<i class="fa fa-arrow-right"></i> Next') : Yii::t('app', 'Next'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
        </div>
    </div>
</div>


<?php ActiveForm::end(); ?>
<script>
    function myFunction() {
        var checkBox = document.getElementById("myCheck");
        var text = document.getElementById("text");
        if (checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
</script>