
<?php

use backend\models\ViambatanishoMzeeSearch;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\datepicker\DatePicker;
use yii\widgets\DetailView;
use yii\grid\GridView;


$searchModel = new ViambatanishoMzeeSearch();
$dataProvider = $searchModel->searchByMzeeId($model->id);
?>
<div class="row">
    <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
        <?php
        $msaidizi = \backend\models\MsaidiziMzee::findOne(['id' => $model->msaidizi_id,'status' => \backend\models\MsaidiziMzee::ACTIVE]);
        if($msaidizi != null){
            echo DetailView::widget([
                'model' => $msaidizi,
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
        }
        ?>
    </div>
<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">

<div style="margin: 10px">
    <?php
    if($msaidizi != null) {
        //echo $msaidizi->picha;
        ?>
        <div class="row">
            <div class="col-lg-12">
                <?php
                if($msaidizi->picha !=null) {
                    echo Html::img('uploads/wasaidizi/' . $msaidizi->picha,
                        ['width' => '150px', 'height' => '150px', 'class' => 'img-square']);
                }else{
                    echo Html::img('uploads/wazee/avatar.jpg',
                        ['width' => '150px', 'height' => '150px', 'class' => 'img-square']);
                }
                ?>
                <br/><br/>
                <p><b>Power of attorney: </b>
                    <?php
                    if($msaidizi->power_of_attorney == null){
                        echo '';
                    }
                    elseif($msaidizi->power_of_attorney!=null){


                        $basepath = Yii::$app->request->baseUrl.'/uploads/viambatanisho/'.$msaidizi->power_of_attorney;
                        //$path = str_replace($basepath, '', $model->attachment);
                        echo Html::a('<i class="fa fa-file-pdf-o text-red"></i>', $basepath, array('target'=>'_blank'));


                    }
                    ?>
                </p>
                <p><b>Mwisho wa power: <?= $msaidizi->tarehe_mwisho_power;?></b></p>
                <?php
                if($msaidizi->power_status == \backend\models\MsaidiziMzee::INACTIVE)
                {
                    $status = 'Muda wake umekwisha';
                }elseif($msaidizi->power_status == \backend\models\MsaidiziMzee::ACTIVE){
                    $status = 'Ipo sawa kwa matumizi';
                }
                ?>
                <p><b>Power status: <?= $status;?></b></p>



            </div>
        </div>
        <?php
    }
    ?>
</div>

</div>

</div>

<legend class="lead text text-primary">Wazee wengine waliowahi kumchukulia fedha mzee huyu</legend>

<div class="row">
    <div class="col-md-12">
        <?php
        $searchModel = new \backend\models\MsaidiziMzeeSearch();
        $dataProvider = $searchModel->searchByMzeeId($model->id);
        ?>
         <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            [
                    'attribute' => 'picha',
                    'format' => 'html',
                    'value' =>  function ($model){
                        if($model->picha !=null) {
                            return Html::img('uploads/wasaidizi/' . $model->picha,
                                ['width' => '70px', 'height' => '70px', 'class' => 'img-circle']);
                        }else{
                            return Html::img('uploads/wazee/avatar.jpg',
                                ['width' => '70px', 'height' => '70px', 'class' => 'img-circle']);
                        }

                    }
            ],
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
            //'mzee_id',


            [
                'attribute' => 'aina_ya_kitambulisho',
                'value' => 'kitambulisho.jina'
            ],
            'nambari_ya_kitambulisho',
            [
                'attribute' => 'uhusiano_id',
                'value' => 'uhusiano.jina'
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
            //'aliyemuweka',
            // 'power_of_attorney',
            // 'tarehe_mwisho_power',
            // 'finger_print',
            // 'power_status',
            // 'muda',

            //['class' => 'yii\grid\ActionColumn',''],
        ],
    ]); ?>

    </div>

</div>