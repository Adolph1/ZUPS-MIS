<?php

use backend\models\WilayaSearch;
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
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-sitemap text-green"></i><strong> REPOTI ZA KILA MWEZI</strong></h3>
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
        $currentMonth = date('m');
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'label' => 'WILAYA',
                'value' => 'jina',
                'pageSummary' =>' Jumla ',

            ],
            [
                'label' => 'WALIOFARIKI',
                'pageSummary' => true,
                'format' => ['decimal', 0],
                'value' => function($model){
<<<<<<< HEAD
            
=======

>>>>>>> 645b4c9d95c16bef4c3cc70813ce1ad0c4cfa930
                    return \backend\models\Mzee::getDeadCurrentMonthByDistrict($model->id);

                }

            ],
            [
                'label' => 'WALIOHAI',
                'format' => ['decimal', 0],
                'pageSummary' => true,
                'value' => function($model){
                   // $currentMonth = date('m');
                    return \backend\models\Mzee::getAliveByDistrict($model->id);

                }

            ],


            //['class' => 'yii\grid\ActionColumn','header' => 'Actions'],
        ]; ?>
        <?php
        $searchModel = new WilayaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $pdfHeader = [
            'L' => [
                'content' => 'ZUPS REPOTI',
            ],
            'C' => [
                'content' => 'WAZEE WALIOFARIKI KIWILAYA KWA MWEZI WA '.date('m'),
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
                'heading' => 'RIPOTI YA WAZEE WALIOFARIKI KWA MWEZI KIWILAYA',
                'before'=>'<span class="text text-primary">Hii ripoti inaonesha wazee waliofariki kwa mwezi huu wa : '.date('m').'</span>',
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

</div>



