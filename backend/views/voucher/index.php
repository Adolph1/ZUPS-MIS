<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VoucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vocha');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-index">


    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA VOCHA</strong>
        </div>
        <div class="col-md-2">

        </div>
    </div>
    <hr/>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'tarehe_kuandaliwa',
            'kumbukumbu_namba',
            'mwezi',
             [
                     'attribute' =>'mwaka',
                    'pageSummary' => 'Jumla'
             ],
             [
                     'attribute' =>  'jumla_fedha',
                       'pageSummary' => true,
                     'format' => ['decimal',2],
                     'value' => function ($model){
                            return \backend\models\Malipo::getTotalPerVoucher($model->id);
                     }
             ],


            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'status',
                'refreshGrid' => true,
                //'format'=>['decimal', 2],
                    'value' => function ($model){
                    if($model->status == 1){
                        return 'IPO WAZI';
                    }else{
                        return 'IMEFUNGWA';
                    }
                    },
                'editableOptions'=> [
                    'header'=>'Status',
                    'size'=>'sm',
                    'formOptions' => ['action' => ['voucher/edit-status']],
                    'asPopover' => true,
                    'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data'=>[1=>'FUNGUA',0=>'FUNGA'],
                    'options'=>[
                        'pluginOptions'=>['min'=>0, 'max'=>5000]
                    ]
                ],
            ],

            [
                'class'=>'kartik\grid\ActionColumn',
                'header'=>'View',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-arrow-right"></span>', $url, [
                            'title' => 'angalia malipo ya wazee',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },


                ]
            ],
        ],
        'showPageSummary' => true,
    ]); ?>
</div>
