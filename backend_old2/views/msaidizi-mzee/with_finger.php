<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MsaidiziMzeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wasaidizi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="msaidizi-mzee-index">


    <?php
    $mkoa = \backend\models\Mkoa::find()->select('id')->where(['zone_id' => \backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
    $wilaya = \backend\models\Wilaya::find()->select('id')->where(['in','mkoa_id',$mkoa]);
    $gridColumns = [

            ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'picha',
            'filter' => '',
            'width' => '10px',
            'value' => function ($model){
                return "<img src='data:image/png;base64,$model->picha', width='70px' height='70px' align='center' style='vertical-align: middle' class='img-circle'/>";
            },
            'format' => ['raw']
        ],

        [
            'attribute' => 'jina_kamili',
            'vAlign' => 'middle',
            'width' => '50px',

            'format' => 'raw',
            'value' => function ($model){
                return Html::a(Html::encode($model->jina_kamili),['view','id'=> $model->id]);

            }
        ],

        [
            'label' => 'Jina la Mzee',
            'vAlign' => 'middle',
            'width' => '50px',
            'format' => 'raw',
            'value' => function ($model){
                return Html::a(Html::encode($model->mzee->majina_mwanzo.' '.$model->mzee->jina_babu),['mzee/view','id'=> $model->mzee_id]);

            }
        ],
        [
            'label' => 'kituo',
            'attribute' => 'id',
            'hAlign' => 'middle',
            'width' => '50px',

            'value' => function ($model){
                return $model->mzee->kituo->kituo;
            }
        ],
        'aliyemuweka',
        'muda',


        [
            'class'=>'kartik\grid\ActionColumn',
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
        'heading' =>  '<strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - WASAIDIZI WA WAZEE WENYE FINGER PRINT</strong>',
            // 'before' => '<span class="text text-red"> *Eligible*</span>'
    ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 10],
   // 'exportConfig' => $gridColumns


    ]); ?>
</div>
