<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TellerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transactions');
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-file-o"></i><strong> ZUPS - MCHANGANUO WA FEDHA VITUONI</strong></h3>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-md-12">
    <?php
    $pdfHeaderJuzi = [
        'L' => [
            'content' => 'ZUPS REPOTI',
        ],
        'C' => [
            'content' => 'MCHANGANUO WA FEDHA VITUONI',
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'arial',
            'color' => '#333333'
        ],
        'R' => [
            'content' => 'Imepakuliwa:'. date('Y-m-d H:i:s'),
        ],
        'line' => true,
    ];

    $pdfFooterJuzi = [
        'L' => [
            'content' => '&copy; ZUPS',
            'font-size' => 10,
            'color' => '#333333',
            'font-family' => 'arial',
        ],
        'C' => [
            'content' => '',
        ],
        'R' => [
            //'content' => 'RIGHT CONTENT (FOOTER)',
            'font-size' => 10,
            'color' => '#333333',
            'font-family' => 'arial',
        ],
        'line' => true,
    ];

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],


            [
                'attribute' => 'trn_dt',
                'pageSummary' => 'Jumla',
            ],
            [
                'attribute' => 'related_customer',
                'label' => 'Karani',
                'vAlign' => 'middle',
                'width' => '200px',

                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\backend\models\Wafanyakazi::find()->where(['zone_id'=>\backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)])->orderBy('jina_kamili')->asArray()->all(), 'id', 'jina_kamili'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    //'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Tafuta kwa jina'],
                'value' => 'cashier.jina_kamili',
                'format' => 'raw',
            ],
            [
                'attribute' => 'pay_point_id',
                'hAlign' => 'middle',
                'width' => '50px',
                // 'noWrap'=>false,

                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\backend\models\Vituo::find()->orderBy('kituo')->asArray()->all(), 'id', 'kituo'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    //'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Tafuta kwa kituo'],
                'value' => 'payPoint.kituo'
            ],

            [
                'attribute' => 'amount',
                'format' => ['decimal',2],
                'label'=> 'Fedha za Wazee',
                'pageSummary' => true,

            ],
            [
                'attribute' => 'amount',
                'label' => 'Zilizotumika',
                'format' => ['decimal',2],
                'pageSummary' => true,
                'value' => function ($model){
                    $paid = \backend\models\KituoMonthlyBalances::getPaid($model->pay_point_id);

                    if($paid != null){
                        return $paid;
                    }else{
                        return 0.00;
                    }
                 }
            ],
            [
                'attribute' => 'amount',
                'label' => 'Bakaa',
                'format' => ['decimal',2],
                'pageSummary' => true,
                'value' => function ($model){
                    $paid = \backend\models\KituoMonthlyBalances::getBalance($model->pay_point_id);

                    if($paid != null){
                        return $paid;
                    }else{
                        return 0.00;
                    }
                }
            ],
            [
                'attribute' => 'amount',
                'label' => 'Zilizoisha muda',
                'format' => ['decimal',2],
                'pageSummary' => true,
                'value' => function ($model){
                    $paid = \backend\models\KituoMonthlyBalances::getExpiredBalance($model->pay_point_id,$model->month,$model->year);

                    if($paid != null){
                        return $paid;
                    }else{
                        return 0.00;
                    }
                }
            ],
            [
                'attribute' => 'amount',
                'format' => ['decimal',2],
                'label'=> 'Fedha za Watendaji',
                'pageSummary' => true,
                'value' => function ($model){
                    $watendaji = \backend\models\MiamalaWatendaji::getTotalAmountGivenByDate($model->pay_point_id,$model->trn_dt);
                    if($watendaji != null){
                        return $watendaji;
                    }else{
                        return 0.00;
                    }
                }

            ],

            [
                'attribute' => 'amount',
                'label' => 'Zilizotumika',
                'format' => ['decimal',2],
                'pageSummary' => true,
                'value' => function ($model){
                    $paid = \backend\models\MiamalaWatendaji::getPaid($model->pay_point_id,$model->related_customer,$model->trn_dt);

                    if($paid != null){
                        return $paid;
                    }else{
                        return 0.00;
                    }
                }
            ],

            [
                'attribute' => 'amount',
                'label' => 'Bakaa',
                'format' => ['decimal',2],
                'pageSummary' => true,
                'value' => function ($model){
                    $paid = \backend\models\MiamalaWatendaji::getBalance($model->pay_point_id,$model->related_customer,$model->trn_dt);

                    if($paid != null){
                        return $paid;
                    }else{
                        return 0.00;
                    }
                }
            ],

            [
                'attribute' => 'amount',
                'label' => 'Jumla Bakaa',
                'format' => ['decimal',2],
                'pageSummary' => true,
                'value' => function ($model){
                    $paid = \backend\models\MiamalaWatendaji::getBalance($model->pay_point_id,$model->related_customer,$model->trn_dt);
                    $wazeebalance = \backend\models\KituoMonthlyBalances::getBalance($model->pay_point_id,$model->month,$model->year);
                    if($paid != null || $wazeebalance != null){
                        return $paid + $wazeebalance;
                    }else{
                        return 0.00;
                    }
                }
            ],








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
        ],
        'showPageSummary' => true,
        'striped'=>true,
        'hover'=>true,
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
            'fontAwesome' => true,
            'filename' => 'Test',

        ],
        'pjaxSettings'=>[
            'neverTimeout'=>true,


        ],
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => 'ORODHA YA MIAMALA',
            //  'before'=>'<span class="text text-primary">Hii ripoti inaonesha jinsi malipo yalivofanyika kwa mwezi wa : '.$mJuzi.'</span>',
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        'exportConfig' => [
            GridView::PDF => [
                'label' => Yii::t('kvgrid', 'PDF'),
                //'icon' => $isFa ? 'file-pdf-o' : 'floppy-disk',
                'iconOptions' => ['class' => 'text-danger'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('kvgrid', 'Zups - MIAMALA ILIYOHAKIKIWA'),
                'alertMsg' => Yii::t('kvgrid', 'The PDF export file will be generated for download.'),
                'options' => ['title' => Yii::t('kvgrid', 'Portable Document Format')],
                'mime' => 'application/pdf',
                'config' => [
                    'mode' => 'c',
                    'format' => 'A4-L',
                    'destination' => 'D',
                    'marginTop' => 20,
                    'marginBottom' => 20,
                    'cssInline' => '.kv-wrap{padding:20px;}' .
                        '.kv-align-center{text-align:center;}' .
                        '.kv-align-left{text-align:left;}' .
                        '.kv-align-right{text-align:right;}' .
                        '.kv-align-top{vertical-align:top!important;}' .
                        '.kv-align-bottom{vertical-align:bottom!important;}' .
                        '.kv-align-middle{vertical-align:middle!important;}' .
                        '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',

                    'methods' => [
                        'SetHeader' => [
                            ['odd' => $pdfHeaderJuzi, 'even' => $pdfHeaderJuzi]
                        ],
                        'SetFooter' => [
                            ['odd' => $pdfFooterJuzi, 'even' => $pdfFooterJuzi]
                        ],
                    ],

                    'options' => [
                        'title' => 'PDF export generated',
                        'subject' => Yii::t('kvgrid', 'PDF export generated by kartik-v/yii2-grid extension'),
                        'keywords' => Yii::t('kvgrid', 'krajee, grid, export, yii2-grid, pdf')
                    ],
                    'contentBefore'=>'',
                    'contentAfter'=>''
                ]
            ],
            GridView::CSV => [
                'label' => 'CSV',
                'filename' => 'MIAMALA ILIYOHAKIKIWA',
                'options' => ['title' => 'Repoti ya mwezi'],
            ],
        ],

    ]);
    ?>
    </div>
</div>
