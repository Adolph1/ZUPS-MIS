<?php

use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Sales */
/* @var $form yii\widgets\ActiveForm */
?>
<?=Html::beginForm(['matumizi-mengine/bulk-pay'],'post');?>
<div class="sales-form">
    <div class="panel panel-primary">
        <div class="panel-heading"><h4><i class="fa fa-bars bg-success"></i> Orodha ya mahitaji</h4></div>
        <div class="panel-body">
<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin([
            'action' => ['create-batch'],
            'method' => 'get',
        ]); ?>


        <?= $form->field($searchModel, 'category_id')->widget(Select2::classname(), [
            'data' => \backend\models\MahitajiCategory::getAll(),
            'language' => 'en',
            'options' => ['placeholder' => 'Tafuta kwa category',],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
            <?php ActiveForm::end(); ?>
            <?php
            Modal::begin([
                'header' => '<h3 class="text text-primary">Fomu ya malipo</h3>',
                'toggleButton' => ['label' => ' <i class="fa fa-money"></i> Lipa uliyochagua', 'class' => 'btn btn-success',],
                'size' => Modal::SIZE_LARGE,
                'options' => ['class' => 'slide', 'id' => 'modal-2'],
            ]);
            ?>
            <div class="maoni-kwa-mzee-form" style="margin-left: 10px">

                <?php $form = ActiveForm::begin(['action' => ['matumizi-mengine/bulk-pay']]); ?>

                <?= $form->field($model,'supplier_id')->dropDownList(\backend\models\Supplier::getAll(),['prompt' => '--Chagua supplier--'])->label(false);?>

                <div class="form-group">


                    <?= Html::submitButton('Lipa',['class' => 'btn btn-primary']) ?>

                   <?= Html::submitButton('<i class="fa fa-check"></i> Approve',
                    [
                    'class' =>Yii::$app->user->can('admin') ? 'btn btn-warning enabled':'btn btn-default disabled',
                    ]
                    );?>
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <?php
            Modal::end();
            ?>
        </div>



    </div>
</div>
            <div class="row">
                <div class="col-md-12">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'showPageSummary' => true,
                        'pjax'=>true,
                        'toolbar' =>  [
                            Html::submitButton('<i class="fa fa-check"></i> Approve',
                                [
                                    'class' =>Yii::$app->user->can('admin') ? 'btn btn-warning enabled':'btn btn-default disabled',
                                ]
                            ),

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
                            'heading' => '',
                            'before'=>'<span class="text text-primary"></span>',
                        ],
                        'persistResize' => false,
                        'toggleDataOptions' => ['minCount' => 10],
                        // 'exportConfig' => $gridColumns
                        'columns' => [
                            ['class' => 'kartik\grid\SerialColumn'],
                            ['class' => '\kartik\grid\CheckboxColumn',
                                'checkboxOptions' => function ($model, $key, $index, $column) {
                                    //if ($model->status == \backend\models\Budget::OPEN) {

                                    //}
                                    return ['value' => $key];
                                    //return ['style' => ['display' => 'none']]; // OR ['disabled' => true]
                                },
                            ],

                            [
                                    'attribute' => 'hitaji',
                                    'pageSummary' => 'Jumla',
                            ],
                            [
                                    'label' => 'Jumla Idadi',
                                    'format' => ['decimal',2],
                                    'pageSummary' => true,
                                    'value' => function($model){
                                        return \backend\models\GharamaMahitaji::getIdadiById($model->id);
                                    }
                            ],
                            [
                                'label' => 'Jumla Fedha',
                                'format' => ['decimal',2],
                                'pageSummary' => true,
                                'value' => function($model){
                                    return \backend\models\GharamaMahitaji::getJumlaById($model->id);
                                }
                            ],


                        ],
                    ]); ?>
                    </div>

                </div>



    </div>
</div>
</div>


