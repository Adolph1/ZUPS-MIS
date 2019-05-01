<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TodayEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Miamala ya mwezi huu';
?>
<div class="row">
    <div class="col-md-12">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'trn_ref_no',
            'trn_dt',
            [
                    'attribute' => 'ac_no',
                    'pageSummary' => 'Jumla',
            ],
            [
                'attribute' => 'drcr_ind',
                'label' => 'KUINGIA',
                'pageSummary' => true,
                'format' => ['decimal',2],
                'value' => function ($model){
                    if($model->drcr_ind == 'C'){
                        return $model->amount;
                    }else{
                        return '';
                    }
                }
            ],
            [
                'attribute' => 'drcr_ind',
                'label' => 'KUTOKA',
                'pageSummary' => true,
                'format' => ['decimal',2],
                'value' => function ($model){
                    if($model->drcr_ind == 'D'){
                        return $model->amount;
                    }else{
                        return '';
                    }
                }
            ],

            'related_customer',


            'maker_id',
            'maker_stamptime',

            [
                    'attribute' => 'module',
                    'value' => function($model){

                        if($model->module == 'DE'){
                            return 'Malipo ya Mzee';
                        }elseif ($model->module == 'CB'){
                            return 'Cash Book';
                        }
                        elseif ($model->module == 'FW'){
                            return 'Malipo ya maafisa';
                        }
                        elseif ($model->module == 'MM'){
                            return 'Malipo ya Bidhaa';
                        }elseif ($model->module == 'MW'){
                            return 'Malipo ya Watendaji';
                        }elseif ($model->module == 'FB'){
                            return 'Budget';
                        }
                    }
            ],

        ],
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
            'heading' => 'Miamala mbalimbali ya kifedha katika kipind cha mwezi huu',
            // 'before' => '<span class="text text-red"> *Eligible*</span>'
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        // 'exportConfig' => $gridColumns

    ]);


    ?>

    </div>

</div>
