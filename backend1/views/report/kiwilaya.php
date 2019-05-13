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
                'label' => 'WALENGWA',
                'pageSummary' => true,
                'format' => ['decimal', 0],
                'value' => function($model){
                    $currentMonth = date('m');
                    return \backend\models\Malipo::getCountPerKiwilaya($model->id,$currentMonth);

                }

            ],
            [
                'label' => 'WALIOLIPWA',
                'format' => ['decimal', 0],
                'pageSummary' => true,
                'value' => function($model){
                    $currentMonth = date('m');
                    return \backend\models\Malipo::getCountPerKiwilayaPaid($model->id,$currentMonth);

                }

            ],
            [
                'label' => 'WASIOLIPWA',
                'pageSummary' => true,
                'format' => ['decimal', 0],
                'value' => function($model){
                    $currentMonth = date('m');
                    return \backend\models\Malipo::getCountPerKiwilayaPending($model->id,$currentMonth);

                }

            ],
            [
                'label' => 'ASILIMIA YA WALIOLIPWA (%)',
                'format' => ['decimal', 2],
                'value' => function($model){
                    $currentMonth = date('m');
                    if(\backend\models\Malipo::getCountPerKiwilaya($model->id,$currentMonth) != 0) {
                        return (100 * \backend\models\Malipo::getCountPerKiwilayaPaid($model->id, $currentMonth) / \backend\models\Malipo::getCountPerKiwilaya($model->id, $currentMonth));
                    }else{
                        return 0.00;
                    }
                }

            ],
            [
                'label' => 'FEDHA ZILIZOTAKIWA KULIPWA',
                'pageSummary' => true,
                'format' => ['decimal', 2],
                'value' => function($model){
                    $currentMonth = date('m');
                    return \backend\models\KituoMonthlyBalances::getBalancePerKiwilaya($model->id,$currentMonth);

                }

            ],
            [
                'label' => 'ZILIZOLIPWA',
                'pageSummary' => true,
                'format' => ['decimal', 2],
                'value' => function($model){
                    $currentMonth = date('m');

                    return \backend\models\KituoMonthlyBalances::getBalancePerKiwilayaPaid($model->id,$currentMonth);

                }

            ],
            [
                'label' => 'ZILIZOBAKI',
                'pageSummary' => true,
                'format' => ['decimal', 2],
                'value' => function($model){
                    $currentMonth = date('m');

                    return \backend\models\KituoMonthlyBalances::getBalancePerKiwilayaBalance($model->id,$currentMonth);

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
                'heading' => 'RIPOTI YA MALIPO YA MWEZI KIWILAYA',
                'before'=>'<span class="text text-primary">Hii ripoti inaonesha jinsi malipo yalivofanyika kwa mwezi huu wa : '.date('m').'</span>',
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
<div class="row">
    <div class="col-md-12">
        <?php
        $mJana = date("m", strtotime("-1 months"));
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            [
                'label' => 'WILAYA',
                'value' => 'jina',
                'pageSummary' => 'Jumla',

            ],
            [
                'label' => 'WALENGWA',
                'pageSummary' => true,
                'format' => ['decimal', 0],
                'value' => function($model){
                    $mJana = date("m", strtotime("-1 months"));
                    return \backend\models\Malipo::getCountPerKiwilaya($model->id,$mJana);

                }

            ],
            [
                'label' => 'WALIOLIPWA',
                'format' => ['decimal', 0],
                'pageSummary' => true,
                'value' => function($model){
                    $mJana = date("m", strtotime("-1 months"));
                    return \backend\models\Malipo::getCountPerKiwilayaPaid($model->id,$mJana);

                }

            ],
            [
                'label' => 'WASIOLIPWA',
                'format' => ['decimal', 0],
                'pageSummary' => true,
                'value' => function($model){
                    $mJana = date("m", strtotime("-1 months"));
                    return \backend\models\Malipo::getCountPerKiwilayaPending($model->id,$mJana);

                }

            ],
            [
                'label' => 'ASILIMIA YA WALIOLIPWA (%)',
                'format' => ['decimal', 2],
                'value' => function($model){
                    $mJana = date("m", strtotime("-1 months"));
                    if(\backend\models\Malipo::getCountPerKiwilaya($model->id,$mJana) != 0) {
                        return (100 * \backend\models\Malipo::getCountPerKiwilayaPaid($model->id, $mJana) / \backend\models\Malipo::getCountPerKiwilaya($model->id, $mJana));
                    }else{
                        return 0.00;
                    }

                }



            ],
            [
                'label' => 'FEDHA ZILIZOTAKIWA KULIPWA',
                'pageSummary' => true,
                'format' => ['decimal', 2],
                'value' => function($model){
                    $mJana = date("m", strtotime("-1 months"));
                    return \backend\models\KituoMonthlyBalances::getBalancePerKiwilaya($model->id,$mJana);

                }

            ],
            [
                'label' => 'ZILIZOLIPWA',
                'pageSummary' => true,
                'format' => ['decimal', 2],
                'value' => function($model){
                    $mJana = date("m", strtotime("-1 months"));
                    return \backend\models\KituoMonthlyBalances::getBalancePerKiwilayaPaid($model->id,$mJana);

                }

            ],
            [
                'label' => 'ZILIZOBAKI',
                'pageSummary' => true,
                'format' => ['decimal', 2],
                'value' => function($model){
                    $mJana = date("m", strtotime("-1 months"));
                    return \backend\models\KituoMonthlyBalances::getBalancePerKiwilayaBalance($model->id,$mJana);

                }

            ],


            //['class' => 'yii\grid\ActionColumn','header' => 'Actions'],
        ]; ?>

        <?php
        $mweziJana = new WilayaSearch();
        $dataProviderJana = $mweziJana->searchJana(Yii::$app->request->queryParams);

        $pdfHeaderJana = [
            'L' => [
                'content' => 'ZUPS REPOTI',
            ],
            'C' => [
                'content' => 'MALIPO YA WAZEE KIWILAYA KWA MWEZI WA '.$mJana,
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

        $pdfFooterJana = [
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
            'dataProvider' => $dataProviderJana,
            // 'filterModel' => $searchModel,
            'columns' => $gridColumns,
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
                'fontAwesome' => true
            ],
            'pjaxSettings'=>[
                'neverTimeout'=>true,


            ],
            'panel' => [
                'type' => GridView::TYPE_INFO,
                'heading' => 'RIPOTI YA MALIPO YA MWEZI ULIOPITA',
                'before'=>'<span class="text text-primary">Hii ripoti inaonesha jinsi malipo yalivofanyika kwa mwezi wa : '.$mJana.'</span>',
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
                                 ['odd' => $pdfHeaderJana, 'even' => $pdfHeaderJana]
                             ],
                             'SetFooter' => [
                                 ['odd' => $pdfFooterJana, 'even' => $pdfFooterJana]
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
<div class="row">
    <div class="col-md-12">
        <?php
        $mJuzi = date("m", strtotime("-2 months"));
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            [
                'label' => 'WILAYA',
                'value' => 'jina',
                'pageSummary' => 'Jumla',

            ],
            [
                'label' => 'WALENGWA',
                'pageSummary' => true,
                'value' => function($model){
                    $mJuzi = date("m", strtotime("-2 months"));
                    return \backend\models\Malipo::getCountPerKiwilaya($model->id,$mJuzi);

                }

            ],
            [
                'label' => 'WALIOLIPWA',
                'pageSummary' => true,
                'value' => function($model){
                    $mJuzi = date("m", strtotime("-2 months"));
                    return \backend\models\Malipo::getCountPerKiwilayaPaid($model->id,$mJuzi);

                }

            ],
            [
                'label' => 'WASIOLIPWA',
                'pageSummary' => true,
                'value' => function($model){
                    $mJuzi = date("m", strtotime("-2 months"));
                    return \backend\models\Malipo::getCountPerKiwilayaPending($model->id,$mJuzi);

                }

            ],
            [
                'label' => 'ASILIMIA YA WALIOLIPWA (%)',
                'format' => ['decimal', 2],
                'value' => function($model){
                    $mJuzi = date("m", strtotime("-2 months"));
                    if(\backend\models\Malipo::getCountPerKiwilaya($model->id,$mJuzi) != 0) {
                        return (100 * \backend\models\Malipo::getCountPerKiwilayaPaid($model->id, $mJuzi) / \backend\models\Malipo::getCountPerKiwilaya($model->id, $mJuzi));
                    }else{
                        return 0.00;
                    }
                }

            ],
            [
                'label' => 'FEDHA ZILIZOTAKIWA KULIPWA',
                'pageSummary' => true,
                'format' => ['decimal', 2],
                'value' => function($model){
                    $mJuzi = date("m", strtotime("-2 months"));
                    return \backend\models\KituoMonthlyBalances::getBalancePerKiwilaya($model->id,$mJuzi);

                }

            ],
            [
                'label' => 'ZILIZOLIPWA',
                'pageSummary' => true,
                'format' => ['decimal', 2],
                'value' => function($model){
                    $mJuzi = date("m", strtotime("-2 months"));
                    return \backend\models\KituoMonthlyBalances::getBalancePerKiwilayaPaid($model->id,$mJuzi);

                }

            ],
            [
                'label' => 'ZILIZOBAKI',
                'pageSummary' => true,
                'format' => ['decimal', 2],
                'value' => function($model){
                    $mJuzi = date("m", strtotime("-2 months"));
                    return \backend\models\KituoMonthlyBalances::getBalancePerKiwilayaBalance($model->id,$mJuzi);

                }

            ],


        ]; ?>

        <?php

        $mweziJuzi = new WilayaSearch();
        $dataProviderJuzi = $mweziJuzi->searchJuzi(Yii::$app->request->queryParams);
        $pdfHeaderJuzi = [
          'L' => [
            'content' => 'ZUPS REPOTI',
          ],
          'C' => [
            'content' => 'MALIPO YA WAZEE KIWILAYA KWA MWEZI WA '.$mJuzi,
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
            'dataProvider' => $dataProviderJuzi,
            // 'filterModel' => $searchModel,
            'columns' => $gridColumns,
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
                'heading' => 'RIPOTI YA MALIPO YA MIEZI MIWILI ILIOPITA',
                'before'=>'<span class="text text-primary">Hii ripoti inaonesha jinsi malipo yalivofanyika kwa mwezi wa : '.$mJuzi.'</span>',
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
                     'filename' => 'ZUPS - RIPOTI YA MWEZI',
                     'options' => ['title' => 'Repoti ya mwezi'],
                 ],
             ],

        ]);
        ?>
    </div>

</div>

