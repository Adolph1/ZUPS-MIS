<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KituoMonthlyBalancesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kituo Monthly Balances');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kituo-monthly-balances-index">


    <?php
    $columns = [
        ['class' => 'kartik\grid\SerialColumn'],

        //'id',
        [
            'attribute' => 'kituo_id',
            'vAlign' => 'middle',
            'pageSummary' => 'Jumla',
            'width' => '400px',

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Vituo::find()->orderBy('kituo')->asArray()->all(), 'id', 'kituo'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa jina'],
          //  'format' => 'raw',
            'value' => function ($model){
                if($model->kituo_id != null){
                    return $model->kituo->kituo;
                }else{
                    return ' ';
                }
            }
        ],
        [
            'attribute' => 'kituo_id',
            'label' => 'Wilaya',
            'vAlign' => 'middle',
            'pageSummary' => 'Jumla',
            'width' => '400px',

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Wilaya::find()->orderBy('jina')->asArray()->all(), 'id', 'jina'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa jina'],
            'format' => 'raw',
            'value' => function ($model){
                if($model->kituo_id != null){
                    return $model->kituo->wilaya->jina;
                }else{
                    return ' ';
                }
            }
        ],
        [
            'attribute' => 'allocated_amount',
            'filter' => '',
            'vAlign' => 'middle',
            'pageSummary' => true,
            'format' => ['decimal',2],
            'width' => '400px',
        ],
        [
            'attribute' => 'paid_amount',
            'filter' => '',
            'format' => ['decimal',2],
            'pageSummary' => true,
            'vAlign' => 'middle',
            'width' => '400px',
        ],
        [
            'attribute' => 'balance',
            'filter' => '',
            'format' => ['decimal',2],
            'pageSummary' => true,
            'vAlign' => 'middle',
            'width' => '400px',
        ],

        'month',
        'year',
        // 'allocated_by',
        // 'allocated_time',
        // 'allocated_to',
        // 'last_access',
        // 'last_access_user',

      //  ['class' => 'yii\grid\ActionColumn'],
        ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
        'pjax'=>true,
        'showPageSummary' => true,
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
            'before' =>  'Kwa mwezi huu',
            'after' => false,
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Jumla ya Fedha kwa kila kituo</h3> ',
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        // 'exportConfig' => $gridColumns

    ]); ?>
</div>
