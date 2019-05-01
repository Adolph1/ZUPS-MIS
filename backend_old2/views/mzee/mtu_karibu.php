
<?php

use backend\models\ViambatanishoMzeeSearch;
use yii\bootstrap\Modal;
use yii\validators\FileValidator;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\datepicker\DatePicker;
use yii\widgets\DetailView;
use yii\grid\GridView;

?>
<div class="row">
    <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
        <?php
       //print_r($model->aina_ya_msaidizi);
        if($model->aina_ya_msaidizi == \backend\models\MsaidiziMzee::MSAIDIZI){
        $msaidizi = \backend\models\MsaidiziMzee::findOne(['id' => $model->msaidizi_id, 'status' => \backend\models\MsaidiziMzee::ACTIVE]);
        if ($msaidizi != null) {
            echo DetailView::widget([
                'model' => $msaidizi,
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
        }
        ?>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">

        <div style="margin: 10px">
            <?php
            if ($msaidizi != null) {
                //echo $msaidizi->picha;
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        if ($msaidizi->picha != null) {


                            $extension = explode(".", $msaidizi->picha);
                            if($extension != null) {

                                if ($extension[1] == 'PNG' || $extension[1] == 'jpg' || $extension[1] == 'jpeg') {

                                    echo Html::img('uploads/wasaidizi/' . $msaidizi->picha,
                                        ['width' => '150px', 'height' => '150px', 'class' => 'img-square']);

                                } else {
                                    // ToDO with error: print_r($errors);
                                    echo "<img src='data:image/png;base64',$msaidizi->picha, width='150px' height='150px' align='center' style='vertical-align: middle'/>";
                                }
                            }

                        } else {
                            echo Html::img('uploads/wazee/avatar.jpg',
                                ['width' => '150px', 'height' => '150px', 'class' => 'img-square']);
                        }
                        ?>
                        <br/><br/>
                        <p><b>Power of attorney: </b>
                            <?php
                            $mz=\backend\models\MsadiziWazeeWengine::findOne(['mzee_id' => $model->id]);
                            if($mz != null){
                            ?>
                            <?php
                            if ($mz->power_of_attorney == null) {
                                echo '';
                            } elseif ($mz->power_of_attorney != null) {


                                $basepath = Yii::$app->request->baseUrl . '/uploads/viambatanisho/' . $mz->power_of_attorney;
                                //$path = str_replace($basepath, '', $model->attachment);
                                echo Html::a('<i class="fa fa-file-pdf-o text-red"></i>', $basepath, array('target' => '_blank'));


                            }
                            ?>
                        </p>
                        <p><b>Mwisho wa power: <?= $mz->valid_date; ?></b></p>
                    <?php
                    if ($mz->status == \backend\models\MsaidiziMzee::INACTIVE) {
                        $status = 'Muda wake umekwisha';
                    } elseif ($mz->status == \backend\models\MsaidiziMzee::ACTIVE) {
                        $status = 'Ipo sawa kwa matumizi';
                    }
                    ?>
                        <p><b>Power status: <?= $status; ?></b></p>

                    <?php
                    }else{
                                echo '<br/>Hana power';
                    }
                                ?>
                    </div>
                </div>
                <?php
            }
            }
            elseif($model->aina_ya_msaidizi == \backend\models\MsaidiziMzee::MZEE){
                $mzee = \backend\models\Mzee::findOne($model->msaidizi_id);
                if ($mzee->picha != null) {

                    echo Html::img('uploads/wasaidizi/' . $mzee->picha,
                        ['width' => '150px', 'height' => '150px', 'class' => 'img-square']);
                } else {

                    echo Html::img('uploads/wazee/avatar.jpg',
                        ['width' => '150px', 'height' => '150px', 'class' => 'img-square']);
                }
                echo \backend\models\Mzee::getFullname($model->msaidizi_id);
            }

    ?>

            <?php
            if ($model->aina_ya_msaidizi == \backend\models\MsaidiziMzee::MZEE && $model->aina_ya_msaidizi == \backend\models\MsaidiziMzee::MSAIDIZI)
            {
                return Html::a(Yii::t('app', '<i class="fa fa-pencil"></i> Edit'), ['msaidizi-mzee/update','id'=> $model->msaidizi_id], ['class' => 'text-default']);

} ?>
</div>

</div>

</div>
