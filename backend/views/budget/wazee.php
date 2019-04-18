<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $model backend\models\Budget */

$this->title = 'Orodha ya wazee katika budget ya mwezi wa '. $model->kwa_mwezi. ', '. $model->kwa_mwaka;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Budgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$searchModel = new \backend\models\MalipoSearch();
$dataProvider = $searchModel->searchByBudgetId($model->id);
$dataProvider->pagination->pageSize=100;

?>
<div class="budget-view">
    <?php
    $pdfHeader = [
        'L' => [
            'content' => 'ZUPS REPOTI',
        ],
        'C' => [
            'content' => 'ORODHA YA WAZEE KATIKA BUDGET HII '.\backend\models\Zone::getZoneNameByuserId(Yii::$app->user->identity->user_id),
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
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],

        // 'id',
        [
            'attribute' => 'mzee_id',
            'value' => function ($model){
                return $model->mzee->majina_mwanzo. ' ' .$model->mzee->jina_babu;
            }
        ],
        'kiasi',

        [
            'attribute' => 'shehia_id',
            'value' => function ($model){
                if($model->shehia_id != null) {
                    return $model->mzee->shehia->jina;
                }else{
                    return;
                }
            }
        ],
        [
            'attribute' => 'kituo_id',
            'label' => 'Kituo',
            'value' => function ($model){
                if($model->kituo_id != null) {
                    return $model->mzee->kituo->kituo;
                }else{
                    return ' ';
                }
            }
        ],

        // 'tarehe_kulipwa',
        /*[
            'attribute' => 'cashier_id',
            'value' => 'cashier.jina_kamili'
        ],*/
        // 'device_number',
        // 'kituo_id',
        [
            'attribute' => 'status',
            'value' => function ($model){
                if($model->status == \backend\models\Malipo::PENDING) {
                    return 'PENDING';
                }elseif ($model->status == \backend\models\Malipo::PAID){
                    return 'PAID';
                }elseif ($model->status == \backend\models\Malipo::EXPIRED){
                    return 'EXPIRED';
                }

            }
        ],
        // 'aliyelipwa',
        // 'muda',

    ];

    ?>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'showPageSummary' => true,
        'striped'=>true,
        'hover'=>true,
        'toolbar' =>  [
        ['content' =>
           // Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['view','id' => $model->id], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
        ],
        '{export}',
        '{toggleData}',
    ],
    // set export properties
    'export' => [
            'fontAwesome' => true
        ],
        'exportConfig' => [
            GridView::PDF => [
                'label' => Yii::t('kvgrid', 'PDF'),
                //'icon' => $isFa ? 'file-pdf-o' : 'floppy-disk',
                'iconOptions' => ['class' => 'text-danger'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('kvgrid', 'Zups - RIPOTI YA BUDGET'),
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
                'filename' => 'ZUPS - RIPOTI YA BUDGET',
                'options' => ['title' => 'Repoti ya mwezi'],
            ],
        ],
        'pjaxSettings'=>[
            'neverTimeout'=>true,


        ],
         'panel' => [
        'type' => GridView::TYPE_INFO,
        'heading' =>  Html::encode($this->title),
        //'before'=>'<span class="text text-primary">Hii repoti inaonesha jinsi malipo yalivofanyika kwa mwezi huu wa : '.$curentMonth.'</span>',
    ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 10],
   // 'exportConfig' => $gridColumns

    ]); ?>
        </div>
    </div>
</div>
