
<?php

use backend\models\ViambatanishoMzeeSearch;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$searchModel = new ViambatanishoMzeeSearch();
$dataProvider = $searchModel->searchByMzeeId($model->id);
?>
<div class="row">
    <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            //filterModel' => $searchModel,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],


                // 'mzee_id',
                [
                    'attribute' => 'aina_id',
                    'value' => 'aina.jina'
                ],
                [
                    'label'=>'Kiambatanisho',
                    'format' => 'raw',
                    'value'=>function($model){
                        if($model->kiambatanisho == null){
                            return '';
                        }
                        elseif($model->kiambatanisho!=null){


                            $basepath = Yii::$app->request->baseUrl.'/uploads/viambatanisho/'.$model->kiambatanisho;
                            //$path = str_replace($basepath, '', $model->attachment);
                            return Html::a('<i class="fa fa-file text-green"></i>', $basepath, array('target'=>'_blank'));


                        }
                    }
                ],

                [
                    'class'=>'yii\grid\ActionColumn',
                    'header'=>'Actions',
                    'template'=>'{view}',
                    'buttons'=>[
                        'view' => function ($url, $model) {
                            $url=['viambatanisho-mzee/delete','id' => $model->id];
                            return Html::a('<span class="fa fa-trash-o"></span>', $url, [
                                'title' => 'View',
                                'data-toggle'=>'tooltip','data-original-title'=>'Save',
                                'class'=>'btn btn-danger',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Unataka kufuta kiambatanisho hiki?'),
                                    'method' => 'post',

                                ],

                            ]);


                        },

                    ]
                ],
            ],
        ]); ?>
    </div>
<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">

    <?php


    if($model->anaishi != \backend\models\Mzee::DIED) {
        Modal::begin([
        'header' => '<h2 class="text-center text-primary">Kiambatanisho Fomu</h2>',
                                                                                 'toggleButton' => ['label' => '<i
                class="fa fa-file-pdf-o text-danger"></i> Ingiza Kiambatanisho Kipya','class' => 'lead btn btn-warning'],
        'size' => Modal::SIZE_LARGE,
        'options' => ['class'=>'slide'],
        ]);
        ?>

        <?php $form = ActiveForm::begin(['action' => ['viambatanisho-mzee/create']]); ?>
        <?= $form->field($kiambatanisho, 'mzee_id')->hiddenInput(['value' => $model->id])->label(false) ?>
        <?= $form->field($kiambatanisho, 'aina_id')->dropDownList(\backend\models\Viambatanisho::getAll(), ['prompt' => '--Chagua--']) ?>

        <?= $form->field($kiambatanisho, 'mzee_kiambatanisho')->fileInput() ?>

        <div class="row">
            <div class="form-group">
                <div class="col-md-6 col-sm-12 col-xs-12">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <?= Html::submitButton($kiambatanisho->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $kiambatanisho->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>

                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                    <?= Html::a(Yii::t('app', 'Cancel'), '#', ['class' => 'btn btn-warning btn-block', 'data-dismiss' => 'modal']) ?>
                </div>
            </div>
        </div>


        <?php ActiveForm::end(); ?>


        <?php

        Modal::end();
    }
    ?>


</div>



</div>