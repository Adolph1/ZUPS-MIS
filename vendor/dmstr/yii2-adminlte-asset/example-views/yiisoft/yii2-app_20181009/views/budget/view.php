<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $model backend\models\Budget */

$this->title = $model->maelezo. ', '.$model->kwa_mwezi. ', '. $model->kwa_mwaka;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Budgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$searchModel = new \backend\models\GharamaMahitajiSearch();
$dataProvider = $searchModel->searchBYBudgetID($model->id);
$dataProvider->pagination->pageSize=100;

?>
<div class="budget-view">
<hr/>
    <div class="row bg-info">
        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 ">
            <h3><?= Html::encode($this->title) ?></h3>
           <?php
           $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],

               [
                   'attribute' => 'wilaya_id',
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
                  'pageSummary' =>' Jumla ',
               ],

               [
                   'class'=>'kartik\grid\EditableColumn',
                   'attribute'=>'idadi_ya_siku',
                  // 'pageSummary' => true,
                   'hAlign' => 'right',
                    'refreshGrid' => true,
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

               ],

               [
                   'class'=>'kartik\grid\EditableColumn',
                   'attribute'=>'idadi_ya_vitu',
                   'refreshGrid' => true,
                  // 'pageSummary' => true,
                   'hAlign' => 'right',
                   //'format' => ['integer', 2],
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

               ],


               [
                   'class'=>'kartik\grid\EditableColumn',
                   'attribute'=>'gharama',
                   //'refreshGrid' => true,
                   'format' => ['decimal', 2],
                //   'pageSummary' => true,
                   'hAlign' => 'right',
                   'editableOptions'=> [
                       'header'=>'Gharama',

                       'size'=>'md',
                       'formOptions' => ['action' => ['/gharama-mahitaji/editcart']],
                       'asPopover' => true,
                       //'inputType'=>Editable::INPUT_SPIN,
                       'options'=>[
                           'pluginOptions'=>['min'=>0, 'max'=>5000],

                       ]
                   ],

               ],


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
                           return Html::a('<span class="fa fa-times text-danger"></span>', $url, [
                               'title' => 'Delete',
                               'data-toggle'=>'tooltip','data-original-title'=>'Save',
                               'data' => [
                                   'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                   'method' => 'post',
                               ],

                           ]);


                       },

                   ]
               ]





           ];

          ?>
        </div>

        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 text-right" style="margin-top:10px">

                <?php
                Modal::begin([
                    'header' => '<h2 class="lead">Mahitaji mengine</h2>',
                    'toggleButton' => ['label' => '<i class="fa fa-plus"></i>','class' => 'lead btn btn-success'],
                    'size' => Modal::SIZE_DEFAULT,
                    'options' => ['class'=>'slide'],
                ]);
                ?>

            <?php $form = ActiveForm::begin(['action' => ['gharama-mahitaji/create']]); ?>
            <?= $form->field($mahitaji, 'budget_id')->hiddenInput(['value' => $model->id])->label(false) ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($mahitaji, 'hitaji_id')->dropDownList(\backend\models\Mahitaji::getAll(),['prompt' => '--Chagua--']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($mahitaji, 'wilaya_id')->dropDownList(\backend\models\Wilaya::getAll(),['prompt' => '--Chagua--']) ?>
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



                <?= Html::a(Yii::t('app', '<i class="fa fa-pencil"></i>'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-trash"></i>'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
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
            ]);*/?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-copy"></i>'), ['clone', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>

        </div>
    </div>
<hr/>
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
        'heading' => 'GHARAMA ZA UENDESHAJI',
        //'before'=>'<span class="text text-primary">Hii repoti inaonesha jinsi malipo yalivofanyika kwa mwezi huu wa : '.$curentMonth.'</span>',
    ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 10],
   // 'exportConfig' => $gridColumns

    ]); ?>
        </div>
    </div>
</div>
