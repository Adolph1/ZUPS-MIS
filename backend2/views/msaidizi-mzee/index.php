<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MsaidiziMzeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Watu wa karibu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="msaidizi-mzee-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - WATU WA KARIBU WA WAZEE</strong>
        </div>

        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-user-plus"></i> Mtu wa karibu Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya watu wa karibu'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
    <?php  //echo 'IDADI YA WASAIDIZI WOTE ';
   // echo  \backend\models\Mzee::find()->count()
    ?>
    <?php
    $gridColumns = [

        ['class' => 'yii\grid\SerialColumn'],
        /*   [
               'attribute' => 'picha',
               'filter' => '',
               'width' => '10px',
               'value' => function ($model){
                   return "<img src='data:image/png;base64,$model->picha', width='70px' height='70px' align='center' style='vertical-align: middle' class='img-circle'/>";
               },
               'format' => ['raw']
           ],*/

        [
            'attribute' => 'jina_kamili',
         //   'vAlign' => 'middle',
        //    'width' => '50px',

            // 'filterType' => GridView::FILTER_SELECT2,
            // 'filter' => ArrayHelper::map(\backend\models\MsaidiziMzee::find()->orderBy('jina_kamili')->asArray()->all(), 'jina_kamili', 'jina_kamili'),
    /*        'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                // 'options' => ['multiple' => true]
            ],*/
         //   'filterInputOptions' => ['placeholder' => 'Tafuta kwa Jina'],
           // 'format' => 'raw',
            'value' => function ($model){
                if($model->jina_kamili != null) {
                    return $model->jina_kamili;
                }

            }
        ],

        [
            'attribute' => 'mzee_id',
            'vAlign' => 'middle',
            'label'=>'Mzee',

         //   'filterInputOptions' => ['placeholder' => 'Tafuta kwa Jina'],
          //  'format' => 'raw',
            'value' =>'mzee.majina_mwanzo'
        ],


        [
            'attribute' => 'jinsia',
            'value' => function ($model){
                if($model->jinsia == 'M'){
                    return 'MWANAUME';
                }elseif($model->jinsia == 'F'){
                    return 'MWANAMKE';
                }else{
                    return '';
                }
            }
        ],
        'nambari_ya_kitambulisho',
        [
            'attribute' => 'uhusiano_id',
            'value' => function ($model){
                if($model->uhusiano_id == null){
                    return '';
                }else{
                    return $model->uhusiano->jina;
                }
            }
        ],
        [

            'attribute' => 'tarehe_mwisho_power',
            'value' => function ($model){
                if($model->tarehe_mwisho_power == null){
                    return '';
                }else{
                    return $model->tarehe_mwisho_power;
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

        [
            'class'=>'yii\grid\ActionColumn',
            'header'=>'Actions',
            'template'=>'{view}',
            'buttons'=>[
                'view' => function ($url, $model) {
                    $url=['view','id' => $model->id];
                    return Html::a('<span class="fa fa-eye"></span>', $url, [
                        'title' => 'View',
                        'data-toggle'=>'tooltip','data-original-title'=>'Save',
                        'class'=>'btn btn-info',

                    ]);


                },

            ]
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'pjax'=>true,
        'toolbar' =>  [
            ['content' =>
            // Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
            ],
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            // 'beforeGrid'=>'My fancy content before.',
            //'afterGrid'=>'My fancy content after.',
        ],
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => 'Orodha ya wasaidizi wa wazee',
            // 'before' => '<span class="text text-red"> *Eligible*</span>'
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        // 'exportConfig' => $gridColumns


    ]); ?>
</div>
