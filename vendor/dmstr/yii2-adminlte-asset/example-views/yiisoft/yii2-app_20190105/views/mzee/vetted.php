<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MzeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wazee');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzee-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA WAZEE WALIOHAKIKIWA</strong>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-user"></i> Mzee Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Wazee'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        /*[
            'attribute' => 'picha',
            'format' => 'html',
            'value' =>  function ($model){
                if($model->picha !=null) {
                    return Html::img('uploads/wazee/' . $model->picha,
                        ['width' => '60px', 'height' => '60px', 'class' => 'img-circle']);
                }else{
                    return Html::img('uploads/wazee/avatar.jpg',
                        ['width' => '60px', 'height' => '60px', 'class' => 'img-circle']);
                }

            }
        ],*/
        //'fomu_namba',
        // 'majina_mwanzo',
        [
            'attribute' => 'majina_mwanzo',
            'vAlign' => 'middle',
            'width' => '180px',

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Mzee::find()->orderBy('majina_mwanzo')->asArray()->all(), 'majina_mwanzo', 'majina_mwanzo'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                // 'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa majina ya mwanzo'],
            'format' => 'raw'
        ],
        [
            'attribute' => 'jina_babu',
            'vAlign' => 'middle',
            'width' => '180px',

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Mzee::find()->orderBy('jina_babu')->asArray()->all(), 'jina_babu', 'jina_babu'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa jina la babu'],
            'format' => 'raw'
        ],


        [
            'attribute' => 'jinsia',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ['M' => 'MWANAUME', 'F' => 'MWANAMKE'],
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa jinsia'],
            'format' => 'raw',
            'value' => function ($model){
                if($model->jinsia == 'M'){
                    return 'MWANAUME';
                }elseif($model->jinsia == 'F'){
                    return 'MWANAMKE';
                }
            }
        ],
        'umri_sasa',


        [
            'attribute' => 'shehia_id',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \backend\models\Shehia::getAll(),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa shehia'],
            'format' => 'raw',
            'value' => function ($model){
                if($model->shehia_id != null){
                    return $model->shehia->jina;
                }else{
                    return '';
                }
            }
        ],
        'aliyeweka',
        'muda',


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





    echo GridView::widget([
        'dataProvider'=> $dataProvider,
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
            'heading' => 'Orodha ya wazee Waliohakikiwa katika shehia mbalimbali',
            'before' => '<span class ="text text-orange">* Wanatakiwa kuthibitishwa kama wanakubaliwa ama wanakataliwa *</span>'
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        // 'exportConfig' => $gridColumns

    ]);


    ?>
</div>
