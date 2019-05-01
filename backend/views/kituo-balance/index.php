<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KituoBalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kituo Balances');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kituo-balance-index">

    <hr/>

    <?php
    $columns = [

        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        [
            'attribute' => 'kituo_id',
            'vAlign' => 'middle',
            'width' => '400px',

            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(\backend\models\Vituo::find()->orderBy('kituo')->asArray()->all(), 'id', 'kituo'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Tafuta kwa jina'],
            'format' => 'raw',
            'value' => function ($model){
                if($model->kituo_id != null){
                    return $model->kituo->kituo;
                }else{
                    return ' ';
                }
            }
        ],
        [
            'attribute' => 'balance',
            'format' => ['decimal', 2],
            'value' => function ($model){
                if($model->balance != null){
                    return $model->balance;
                }else{
                    return '0.00';
                }
            }
        ],

    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => $columns,
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
         'before' =>  '',
         'after' => false,
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Jumla ya Fedha kwa kila kituo</h3> ',
    ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 10],
   // 'exportConfig' => $gridColumns

    ]); ?>
</div>
