<?php

use backend\models\WilayaSearch;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MalipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Malipo');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-sitemap text-green"></i><strong> RIPOTI INAYOONESHA MCHANGANUO WA FEDHA VITUONI,ZILIZOLIPWA NA ZILIZOBAKI</strong></h4>
    </div>
</div>
<hr>
<div id="loader1" style="display: none"></div>
<?php $form = ActiveForm::begin(); ?>

<hr>
<?php ActiveForm::end(); ?>

<div class="row">
    <div class="col-md-12">
        <?php
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'label' => 'Tarehe',

                'value' => 'value_date',


            ],
            [
                'label' => 'KARANI',
              //  'pageSummary' =>' Jumla ',
                'value' => function($model){
                            return \backend\models\Wafanyakazi::getFullnameByUserId(\backend\models\CashierAccount::getCustomerNumberByAccount($model->account));
                },


            ],

            [
                'label' => 'JUMLA YA FEDHA ALIZOPEWA',
                'pageSummary' => true,
                'format' => ['decimal', 2],
                'value' => 'Cedit_tur'

            ],
            [
                'label' => 'JUMLA YA FEDHA ALIZOWALIPA WAZEE',
                'pageSummary' => true,
                'format' => ['decimal', 2],
                'value' => function($model){
                    return \backend\models\Malipo::getSumPerCashierID(\backend\models\CashierAccount::getCustomerNumberByAccount($model->account),$model->value_date);
                },

            ],
            [
                'label' => 'JUMLA YA FEDHA ZILIZOBAKIA',
                'pageSummary' => true,
                'format' => ['decimal', 2],
                'value' => function($model){
                    return $model->Cedit_tur - \backend\models\Malipo::getSumPerCashierID(\backend\models\CashierAccount::getCustomerNumberByAccount($model->account),$model->value_date);
                },
            ],

            [
                'label' => 'STATUS',
                'value' => function($model){
                    if($model->status == 'U'){
                        return 'Mahesabu hayajafungwa bado';
                    }elseif($model->status == 'A'){
                        return 'Mahesabu yamefungwa';
                    }
                },
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view}',
                'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('<span class="fa fa-pencil"></span>','#', [
                        'id' => 'activity-view-link',
                        'title' => Yii::t('yii', 'View'),
                        'data-toggle' => 'modal',
                        'data-target' => '#activity-modal',
                        'data-id' => $key,
                        'data-pjax' => '0',

                    ]);
                },
            ],
           ],

            /*[
                'class'=>'kartik\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        if ($model->status == 'U') {
                            $url = ['balance', 'id' => $model->id];
                            return Html::a('<span class="fa fa-lock"></span>', $url, [
                                'title' => 'Funga hesabu',
                                'data-toggle' => 'tooltip', 'data-original-title' => 'Funga hesabu',
                                'class' => 'btn btn-warning',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Unadhibitisha na kufunga mahesabu ya karani huyu?'),
                                    'method' => 'post',

                                ],

                            ]);


                        }
                    },

                ]
            ],*/


            //['class' => 'yii\grid\ActionColumn','header' => 'Actions'],
        ]; ?>
        <?php
        $searchModel = new \backend\models\AccdailyBalSearch();
        $dataProvider = $searchModel->searchToday(Yii::$app->request->queryParams);
        $pdfHeader = [
            'L' => [
                'content' => 'ZUPS REPOTI',
            ],
            'C' => [
                'content' => 'MALIPO YA WAZEE KIWILAYA KWA MWEZI WA '.date('m'),
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

        $pdfFooter = [
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
        ?>

        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => $gridColumns,
            'striped'=>true,
            'showPageSummary' => true,
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
                'fontAwesome' => true
            ],
            'pjaxSettings'=>[
                'neverTimeout'=>true,


            ],
            'panel' => [
                'type' => GridView::TYPE_INFO,
                'heading' => 'MCHANGANUO WA FEDHA KWA KILA KARANI',
                'before'=>'<span class="text text-primary">Hii ripoti ni ya tarehe:</span>',
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
                    'filename' => Yii::t('kvgrid', 'Zups - Repoti ya malipo kiwilaya'),
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
                                ['odd' => $pdfHeader, 'even' => $pdfHeader]
                            ],
                            'SetFooter' => [
                                ['odd' => $pdfFooter, 'even' => $pdfFooter]
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
                    'filename' => 'ZUPS - RIPOTI YA MWEZI',
                    'options' => ['title' => 'Repoti ya mwezi'],
                ],
            ],

        ]);
        ?>
    </div>

    <div id="loader1" style="display: none"></div>
    <?php Modal::begin([
        'id' => 'activity-modal',
        'header' => '<h4 class="modal-title">Repayment Form</h4>',
        'size'=>'modal-sm',

    ]); ?>

    <?php $form = ActiveForm::begin(); ?>






    <div class="form-group text-right">
        <?=
        Html::Button(Yii::t('app', '<i class="fa fa-check"></i> Save'), [
            'class' => 'btn btn-primary',
            'value'=> 'Submit',
            'id'=>'repay-id',
            'name' => 'submit',
        ]);
        ?>
        <?= Html::Button(Yii::t('app', 'Cancel'), ['class' => 'btn btn-default','id'=>'cancel-repay-id']) ?>
    </div>

    <?php ActiveForm::end(); ?>


    <?php Modal::end(); ?>


</div>


