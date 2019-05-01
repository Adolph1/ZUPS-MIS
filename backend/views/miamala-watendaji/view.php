<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use dosamigos\datepicker\DatePicker;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\MiamalaWatendaji */

$this->title = 'Karani - '.$model->cashier->jina_kamili;
$this->params['breadcrumbs'][] = ['label' => 'Miamala Ya Watendaji'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="miamala-watendaji-view">

    <hr/>
    <div class="row">
        <div class="col-md-4">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - TAARIFA ZA MUAMALA</strong>
        </div>
        <div class="col-md-2">
            <?php
            if(Yii::$app->user->can('Cashier')) {
                ?>
                <p><?= 'Kiasi kilichobaki '.Yii::$app->formatter->asDecimal($model->kiasi_kilichobaki,2); ?></p>
                <?php
            }
            ?>
        </div>

        <div class="col-md-6">
            <?php
            if(!Yii::$app->user->can('Cashier')) {
                ?>

                <?= Html::a(Yii::t('app', '<i class="fa fa-money"></i> Muamala Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Miamala'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
                <?php
            }
            ?>

            <?php
            Modal::begin([
                'header' => '<h2 class="lead">Fomu ya malipo ya watendaji</h2>',
                'toggleButton' => ['label' => '<i class="fa fa-plus"></i> Ingiza Malipo','class' => 'lead btn btn-success'],
                'size' => Modal::SIZE_DEFAULT,
                'options' => ['class'=>'slide'],
            ]);
            ?>

            <?php $form = ActiveForm::begin(['action' => ['malipo-watendaji/create']]); ?>
            <?= $form->field($malipo, 'muamala_id')->hiddenInput(['value' => $model->id])->label(false) ?>


            <?= $form->field($malipo, 'tarehe_ya_kulipwa')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',

                ],
                'options'=>['placeholder'=>'Ingiza tarehe ya muamala']
            ]);?>

            <?= $form->field($malipo, 'jina_kamili')->textInput(['maxlength' => true,'placeholder' => 'Ingiza jina kamili']) ?>

            <?= $form->field($malipo, 'kiasi_alichopewa')->textInput(['maxlength' => true,'placeholder' => 'Ingiza Kiasi alichopewa']) ?>

            <?= $form->field($malipo, 'kazi_yake')->textInput(['maxlength' => true,'placeholder' => 'Ingiza Kazi yake']) ?>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                        <?= Html::submitButton($malipo->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $malipo->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>


            <?php

            Modal::end();
            ?>

        </div>

    </div>
    <hr/>
    <?php

    $searchModel = new \backend\models\MalipoWatendajiSearch();
    $dataProvider = $searchModel->searchByMuamalaId($model->id);
    $pdfHeader = [
        'L' => [
            'content' => 'ZUPS REPOTI',
        ],
        'C' => [
            'content' => 'MALIPO YA WATENDAJI',
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'arial',
            'color' => '#333333'
        ],
        'R' => [
            'content' => 'Imepakuliwa:' . date('Y-m-d H:i:s'),
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
if(!Yii::$app->user->can('Cashier')) {
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'tarehe_ya_kupewa',
            [
                'attribute' => 'cashier_id',
                'value' => function ($model) {
                    if ($model->cashier_id != null) {
                        return $model->cashier->jina_kamili;
                    } else {
                        return '';
                    }
                }
            ],
            [
                'attribute' => 'kituo_id',
                'value' => function ($model) {
                    if ($model->kituo_id != null) {
                        return $model->kituo->kituo;
                    } else {
                        return '';
                    }
                }
            ],
            'kiasi',
            'kiasi_kilicholipwa',
            'kiasi_kilichobaki',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    if ($model->status == 0) {
                        return 'PENDING';
                    } elseif ($model->status == 1) {
                        return 'CLOSED';
                    }
                }
            ],

        ],
    ]);


    ?>

    <p class="pull-right">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
        }?>
    </p>


</div>

<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],

                // 'id',
                // 'muamala_id',
                'tarehe_ya_kulipwa',

                [
                    'attribute' => 'jina_kamili',
                    'pageSummary' => 'Jumla',


                ],
                [
                    'attribute' => 'kiasi_alichopewa',
                    'pageSummary' => true,
                    'format' => ['decimal', 2]


                ],

                'kazi_yake',

                [
                    'class' => 'kartik\grid\ActionColumn',
                    'header' => 'View',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            $url = ['malipo-watendaji/delete', 'id' => $model->id];
                            return Html::a('<span class="fa fa-trash-o"></span>', $url, [
                                'title' => 'Futa',
                                'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],

                            ]);


                        },


                    ]
                ],
            ],
            'striped' => true,
            'showPageSummary' => true,
            'hover' => true,
            'toolbar' => [
                [//'content' =>
                // Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                    //Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
                ],
                '{export}',
                '{toggleData}',
            ],
            // set export properties
            'export' => [
                'fontAwesome' => true
            ],
            'pjaxSettings' => [
                'neverTimeout' => true,


            ],
            'panel' => [
                'type' => GridView::TYPE_INFO,
                'heading' => 'RIPOTI YA MALIPO YA WATENDAJI',
                //'before'=>'<span class="text text-primary">Hii ripoti inaonesha jinsi malipo yalivofanyika kwa mwezi huu wa : '.date('m').'</span>',
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
                    'filename' => Yii::t('kvgrid', 'Zups - Repoti ya malipo ya watendaji'),
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
                        'contentBefore' => '',
                        'contentAfter' => ''
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
