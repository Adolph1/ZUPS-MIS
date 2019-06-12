<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->product_id;
?>

<div class="row">
    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">



        <?= Html::a(Yii::t('app', '<i class="fa fa-money text-yellow"></i> ADD NEW PRODUCT'), ['create'], ['class' => 'btn btn-default text-green']) ?>


        <?= Html::a(Yii::t('app', '<i class="fa fa-th text-yellow"></i> PRODUCTS LIST'), ['index'], ['class' => 'btn btn-default text-green']) ?>

    </div>
    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-8">
        <?php

        $data = \backend\models\Product::find()
            ->select(['product_descption as value', 'product_descption as  label','product_id as product_id'])
            ->asArray()
            ->all();

        //echo 'Product Name' .'<br>';
        echo AutoComplete::widget([
            'options'=>[
                'placeholder'=>'Search Product',
                //'style'=>'width:300px;padding:8px',
                'class'=>'form-control search-form'
            ],
            'clientOptions' => [
                'source' => $data,
                'minLength'=>'3',
                'autoFill'=>true,
                'select' => new JsExpression("function( event, ui ) {
                    
                    $('#memberssearch-family_name_id').val(ui.item.product_id);
                    var id=ui.item.product_id;
                    //alert(ui.item.product_id);
                    $('#prod-id').html(id);
                     $('#loader1' ).show( 'slow', function(){
                      $.get('".Yii::$app->urlManager->createUrl(['product/search','id'=>''])."'+id,function(data) {
                    
                        setTimeout(refresh, 30000);
                 
                        });

                     });
     
                 }")],
        ]);
        ?>

        <?= Html::activeHiddenInput($model, 'product_detail',['id'=>'prd-id'])?>

    </div>

    <div id="loader1" style="display: none"></div>

    <div class="col-lg-2 col-md-8 col-sm-8 col-xs-8">

        <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php
                if($model->record_stat=='O') {

                    echo Html::a(Yii::t('app', '<i class="fa fa-pencil text-blue"></i> Edit'), ['update', 'id' => $model->product_id], ['class' => 'btn btn-default']) ;

                    echo Html::a(Yii::t('app', '<i class="fa fa-times text-red"></i> Disable'), ['delete', 'id' => $model->product_id], [
                        'class' => 'btn btn-default',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this product?'),
                            'method' => 'post',
                        ],
                    ]);
                } elseif($model->record_stat=='D'){
                    echo Html::a(Yii::t('app', '<i class="fa fa-check text-green"></i> Enable'), ['enable', 'id' => $model->product_id], [
                        'class' => 'btn btn-default',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to enable this product?'),
                            'method' => 'post',
                        ],
                    ]);
                }

                ?>
            </ul>
        </div>

    </div>


</div>
<hr>

<div class="row">
<div class="col-lg-3 col-md-3 col-sm-12 col-xs=12">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'product_id',
            'product_descption',
            'product_group',

        ],

    ]) ?>
    <p style="float: right">
        <?php
        if($model->record_stat!='D' && $model->auth_stat=='U') {
            echo Html::a(Yii::t('app', '<i class="fa fa-check text-green"></i> Authorize'), ['approve', 'id' => $model->product_id], [
                'class' => 'btn btn-default',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to approve this product?'),
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>
</div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs=12">
        <?php

        echo TabsX::widget([
            'position' => TabsX::POS_ABOVE,
            'align' => TabsX::ALIGN_LEFT,
            'items' => [
                [
                    'label' => 'Accounting roles',
                    'content' => $this->render('account_roles',['model'=>$model,'dataRoles'=>$dataRoles,'modelaccrole'=>$modelaccrole,]),
                    //'active' => $model->status==1,
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'visible'=>$model->record_stat!='D',
                    'options' => ['style' => 'background:#fff'],

                ],
                [
                    'label' => 'Accounting events',
                    'content' => $this->render('account_events',['model'=>$model,'dataEvents'=>$dataEvents,'modelevent'=>$modelevent]),
                    //'active' => $model->status==1,
                    'visible'=>$model->record_stat!='D',
                    'headerOptions' => ['style'=>'font-weight:bold'],
                    'options' => ['style' => 'background:#fff'],

                ],
                
            ],
        ]);
        ?>
    </div>

</div>
