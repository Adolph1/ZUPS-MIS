<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MsaidiziMzeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Msaidizi Mzees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="msaidizi-mzee-index">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - WASAIDIZI WA WAZEE</strong>
        </div>
        <div class="col-md-3">

        </div>
        <div class="col-md-3">


            <?= Html::a(Yii::t('app', '<i class="fa fa-map-marker"></i> Msaidizi Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Wasaidizi'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
    <?php
    $gridColumns = [

            ['class' => 'yii\grid\SerialColumn'],

            //  'id',
            'jina_kamili',
            'jinsia',
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

            'tarehe_mwisho_power',
            //'status',

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
