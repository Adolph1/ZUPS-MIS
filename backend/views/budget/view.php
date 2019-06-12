<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $model backend\models\Budget */

$this->title = $model->kwa_mwezi. ', '. $model->kwa_mwaka;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Budgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$searchModel = new \backend\models\GharamaMahitajiSearch();
$dataProvider = $searchModel->searchBYBudgetID($model->id);
$dataProvider->pagination->pageSize=100;

?>
<div class="budget-view">

    <?php

    if($model->status == \backend\models\Budget::OPEN){
        $siku = [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'idadi_ya_siku',
            // 'pageSummary' => true,
            'hAlign' => 'right',
            //'refreshGrid' => true,
            'editableOptions'=> [
                'header'=>'Idadi ya siku',
                'size'=>'md',
                'formOptions' => ['action' => ['/gharama-mahitaji/editcart']],
                'asPopover' => true,
                //'inputType'=>Editable::INPUT_SPIN,
                'options'=>[
                    'pluginOptions'=>['min'=>0, 'max'=>5000],

                ]
            ],

        ];

        $idadi = [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'idadi_ya_vitu',
            // 'refreshGrid' => true,
            'pageSummary' => true,
            'hAlign' => 'right',
            //'format' => ['decimal', 2],
            'editableOptions'=> [
                'header'=>'Idadi ya vitu',
                'size'=>'md',
                'formOptions' => ['action' => ['/gharama-mahitaji/editcart']],
                'asPopover' => true,
                //'inputType'=>Editable::INPUT_SPIN,
                'options'=>[
                    'pluginOptions'=>['min'=>0, 'max'=>5000],

                ]
            ],

        ];


       $gharama = [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'gharama',
            //'refreshGrid' => true,
            'format' => ['decimal', 2],
            //   'pageSummary' => true,
            'hAlign' => 'right',
            'editableOptions'=> [
                'header'=>'Gharama',
                //  'class' =>$model->status == \backend\models\Budget::OPEN ? 'enabled':'disabled',
                'size'=>'md',
                'formOptions' => ['action' => ['/gharama-mahitaji/editcart']],
                'asPopover' => true,
                //'inputType'=>Editable::INPUT_SPIN,
                'options'=>[
                    'pluginOptions'=>['min'=>0, 'max'=>5000],

                ]
            ],

        ];

    }else
    {
        $siku =[
            //'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'idadi_ya_siku',
            // 'pageSummary' => true,
            'hAlign' => 'right',


        ];

        $idadi = [
            //'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'idadi_ya_vitu',
            // 'refreshGrid' => true,
            'pageSummary' => true,
            'hAlign' => 'right',


        ];


        $gharama = [
           // 'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'gharama',
            //'refreshGrid' => true,
            'format' => ['decimal', 2],


        ];
    }
    ?>
    <?php
    $pdfHeader = [
        'L' => [
            'content' => 'ZUPS REPOTI',
        ],
        'C' => [
            'content' => 'BUDGET YA UENDESHAJI ZOEZI LA MALIPO '.\backend\models\Zone::getZoneNameByuserId(Yii::$app->user->identity->user_id),
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

        [
            'attribute' => 'wilaya_id',
            'group' => true,
            'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
                return [
                    'mergeColumns'=>[[1,3]], // columns to merge in summary
                    'content'=>[             // content to show in each summary cell
                        1=>'JUMLA NDOGO ',
                       // 4=>GridView::F_SUM,
                      //  5=>GridView::F_SUM,
                        6=>GridView::F_SUM,
                    ],
                    'contentFormats'=>[      // content reformatting for each summary cell
                        4=>['format'=>'number', 'decimals'=>0],
                        5=>['format'=>'number', 'decimals'=>2],
                        6=>['format'=>'number', 'decimals'=>2],
                    ],
                    'contentOptions'=>[      // content html attributes for each summary cell
                        1=>['style'=>'font-variant:small-caps'],
                        4=>['style'=>'text-align:right'],
                        5=>['style'=>'text-align:right'],
                        6=>['style'=>'text-align:right'],
                    ],
                    // html attributes for group summary row
                    'options'=>['class'=>'danger','style'=>'font-weight:bold;']
                ];
            },

            'label' => 'Wilaya / Ofisi',
            'value' => function ($model){
                if($model->wilaya_id == null){
                    return 'OFISI';
                }else{
                    return $model->wilaya->jina;
                }
            }
        ],
        [
            'attribute' => 'hitaji_id',
            'label' => 'Mahitaji',
            'value' => 'hitaji.hitaji',
            'pageSummary' =>' JUMLA KUU ',
        ],

       $siku,
        $idadi,
        $gharama,

        [
            'attribute' => 'total',
            'format' => ['decimal', 2],
            'hAlign' => 'right',
            'pageSummary' =>true
        ],
        [
            'class'=>'kartik\grid\ActionColumn',
            'header'=>'Actions',
            'template'=>'{delete}',
            'buttons'=>[
                'delete' => function ($url, $model) {
                    $url=['gharama-mahitaji/delete','id' => $model->id];
                    if(($model->budget->status == \backend\models\Budget::OPEN) && Yii::$app->user->can('createBudget')) {
                        return Html::a('<span class="fa fa-times text-danger"></span>', $url, [
                            'title' => 'Delete',
                            'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                            'data' => [
                                'confirm' => Yii::t('app', 'unahakika,unataka kufuta matumizi haya?'),
                                'method' => 'post',
                            ],

                        ]);

                    }
                },

            ]
        ]





    ];

    ?>
        <?php
        if(Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('admin') )
        {
        ?>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12" style="margin-top:10px">

            <?php

            Modal::begin([
                'header' => '<h2 class="lead">Mahitaji mengine</h2>',
                'toggleButton' => ['label' => '<i class="fa fa-plus"></i>', 'class' => 'lead btn btn-success'],
                'size' => Modal::SIZE_DEFAULT,
                'options' => ['class' => 'slide'],
            ]);
            ?>

            <?php $form = ActiveForm::begin(['action' => ['gharama-mahitaji/create']]); ?>
            <?= $form->field($mahitaji, 'budget_id')->hiddenInput(['value' => $model->id])->label(false) ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($mahitaji, 'hitaji_id')->dropDownList(\backend\models\Mahitaji::getAll(), ['prompt' => '--Chagua--']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($mahitaji, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAll(), ['prompt' => '--Chagua--']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($mahitaji, 'idadi_ya_siku')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($mahitaji, 'idadi_ya_vitu')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($mahitaji, 'gharama')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                    </div>
                </div>
            </div>


            <?php ActiveForm::end(); ?>


            <?php

            Modal::end();
            ?>




            <?= Html::a(Yii::t('app', '<i class="fa fa-trash"></i>'), ['delete', 'id' => $model->id], [
                'class' => $model->status == \backend\models\Budget::OPEN ? 'btn btn-danger enabled':'btn btn-danger disabled',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>

            <?php
            /* echo ExportMenu::widget([
             'dataProvider' => $dataProvider,
             'columns' => $gridColumns,
             'showPageSummary' => true,
             ]);*/
            ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-copy"></i>'), ['clone', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>

        </div>

    <hr/>
    <?php
    }
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
