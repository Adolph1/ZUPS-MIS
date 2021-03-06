<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MalipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Malipo');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malipo-index">
    <hr/>
    <?php
    $curentMonth = date('m');
    $previousOne =  date('m',strtotime("-1 month"));
    $previousTwo =  date('m',strtotime("-2 month"));

    $curentYear = date('Y');
    $previousYear = $curentYear -1;
    ?>
    <?=Html::beginForm(['malipo/bulk-pay'],'post');?>
    <div style="float: right;"><?=Html::submitButton('<i class="fa fa-check"></i> Lipa Uliowachagua', ['class' => 'btn btn-info',]);?></div>
    <?php
    $gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

           // 'id',
        [
            'class'=>'kartik\grid\CheckboxColumn',
            //'headerOptions'=>['class'=>'kartik-sheet-style'],
        ],
            [
                'attribute' => 'mzee_id',
                'vAlign' => 'middle',
               // 'width' => '400px',

                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\backend\models\Mzee::find()->orderBy('majina_mwanzo')->asArray()->all(), 'id', 'majina_mwanzo'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    //'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Tafuta kwa jina'],
                'value' => function ($model){
                    // return $model->mzee->majina_mwanzo. ' ' .$model->mzee->jina_babu;
                    return Html::a(Html::encode($model->mzee->majina_mwanzo .' '.$model->mzee->jina_babu),['mzee/view','id'=> $model->mzee_id]);
                },
                'format' => 'raw',
            ],
        [
                'attribute' => 'mzee_id',
                'vAlign' => 'middle',
               // 'width' => '400px',
                'label'=>'Kitambulisho',
                'value' => function ($model){
                    // return $model->mzee->majina_mwanzo. ' ' .$model->mzee->jina_babu;
                    return Html::a(Html::encode($model->mzee->nambar),['mzee/view','id'=> $model->mzee_id]);
                },
                'format' => 'raw',
            ],
        [
            'attribute' => 'mzee_id',
            'label' => 'Mtu wa karibu',
            'value' => 'mzee.msaidizi.jina_kamili'
        ],
        'kiasi',

           [
               'attribute' => 'voucher_id',
               'filterType' => GridView::FILTER_SELECT2,
               'filter' => ArrayHelper::map(\backend\models\Voucher::find()->where(['in','mwezi',[$curentMonth,$previousOne,$previousTwo]])->orderBy('mwezi')->asArray()->all(), 'id', 'mwezi'),
               'filterWidgetOptions' => [
                   'pluginOptions' => ['allowClear' => true],
                   //'options' => ['multiple' => true]
               ],
               'filterInputOptions' => ['placeholder' => 'Tafuta kwa mwezi'],
               'label' => 'Mwezi',
               'value' => 'voucher.mwezi'
           ],
        [
            'attribute' => 'voucher_id',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Voucher::find()->where(['in','mwaka',[$curentYear,$previousYear]])->orderBy('mwaka')->asArray()->all(), 'id', 'mwaka'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa mwaka'],
            'label' => 'Mwaka',
            'value' => 'voucher.mwaka'
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
       [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'remarks',
            // 'refreshGrid' => true,
            'pageSummary' => true,
            'hAlign' => 'left',
            //'format' => ['decimal', 2],
            'editableOptions'=> [
                'header'=>'Remarks',
                'size'=>'md',
                'formOptions' => ['action' => ['/malipo/editmalipo']],
                'asPopover' => true,
                //'inputType'=>Editable::INPUT_SPIN,
                'options'=>[
                    'pluginOptions'=>['min'=>0, 'max'=>5000],

                ]
            ],

        ],


            /*[
                'attribute' => 'status',
                'vAlign' => 'middle',
                'width' => '100px',

                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \backend\models\Malipo::getStatus(),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    //'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Tafuta kwa Status'],
                'value' => function ($model){
                    if($model->status == \backend\models\Malipo::PENDING) {
                        return 'PENDING';
                    }elseif ($model->status == \backend\models\Malipo::PAID){
                        return 'PAID';
                    }elseif ($model->status == \backend\models\Malipo::EXPIRED){
                        return 'EXPIRED';
                    }

                }
            ],*/



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
        'heading' => 'WAZEE WANAOSUBIRI KULIPWA',
        'before'=>'<span class="text text-primary">Hii ni orodha ya malipo ya wazee ndani ya miezi mitatu:'.$previousTwo.','.$previousOne.','.$curentMonth.'</span>',
    ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 10],
   // 'exportConfig' => $gridColumns

    ]);
    ?>
    <?= Html::endForm();?>
</div>
