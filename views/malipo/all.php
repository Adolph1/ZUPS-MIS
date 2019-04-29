<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MalipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Malipo ya wazee');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malipo-index">
    <hr/>
    <?php
    $gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            [
                'attribute' => 'mzee_id',
                'vAlign' => 'middle',
                'width' => '400px',

                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\backend\models\Mzee::find()->orderBy('majina_mwanzo')->asArray()->all(), 'id', 'majina_mwanzo'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    //'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Tafuta kwa jina'],
                'value' => function ($model){
                    // return $model->mzee->majina_mwanzo. ' ' .$model->mzee->jina_babu;
                    return Html::a(Html::encode($model->mzee->majina_mwanzo .' '.$model->mzee->jina_babu),['mzee/view','id'=> $model->id]);
                },
                'format' => 'raw',
            ],
        'kiasi',
        [
            //'class'=>'kartik\grid\EditableColumn',
            'attribute' => 'siku_mwisho',
            'value' => 'siku_mwisho',
            'width' => '180px',

        ],
           [
               'attribute' => 'voucher_id',
               'filterType' => GridView::FILTER_SELECT2,
               'filter' => ArrayHelper::map(\backend\models\Voucher::find()->orderBy('mwezi')->asArray()->all(), 'id', 'mwezi'),
               'filterWidgetOptions' => [
                   'pluginOptions' => ['allowClear' => true],
                   //'options' => ['multiple' => true]
               ],
               'filterInputOptions' => ['placeholder' => 'Tafuta kwa mwezi'],
               'label' => 'Mwezi',
               'value' => 'voucher.mwezi'
           ],
           // 'siku_kwanza',
           // 'siku_pili',
          //  'siku_mwisho',
            [
                'attribute' => 'shehia_id',
                'vAlign' => 'middle',
                'width' => '100px',

                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\backend\models\Shehia::find()->orderBy('jina')->asArray()->all(), 'id', 'jina'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    //'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Tafuta kwa shehia'],
                'value' => function ($model){
                    return $model->mzee->shehia->jina;
                }
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


        ],
         'panel' => [
        'type' => GridView::TYPE_INFO,
        'heading' => 'RIPOTI YA MALIPO',
        'before'=>'<span class="text text-primary"></span>',
    ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 10],
   // 'exportConfig' => $gridColumns

    ]);
    ?>
</div>
