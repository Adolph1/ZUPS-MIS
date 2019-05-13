<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GeneralLedgerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chart of Accounts';
?>

<div class="row">
    <div class="col-md-10">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-bank"></i><strong> CHART OF ACCOUNTS</strong></h3>
    </div>
    <div class="col-md-2 text-center">
        <?=  Html::a('Add Account', ['create'], ['class' => 'btn btn-default text-green']) ?>
    </div>
</div>
<hr>
<div class="row">

    <div class="col-md-12">


    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'gl_code',
            'gl_description',
            [
                'attribute' => 'glCategory',
                'value' => 'glCategory.category_name'
            ],
            [
                'attribute' => 'parent_gl',
                'value' => function ($model){

                    if($model->parent_gl==""){

                        return "";
                    }else{
                        return $model->parentID->gl_description;
                    }
                }
            ],
            /*[
                'attribute' =>'posting_restriction',
                'value' => function ($searchModel) {
                    if ($searchModel->posting_restriction=='1')
                    {
                        return 'Direct Posting';
                    }
                    else
                    {
                        return 'Indirect Posting';
                    }
                }],

            [
                'attribute' => 'glType',
                'value' => 'glType.name'
            ],
            [
                'attribute' =>'customer',
                'value' => function ($searchModel) {
                    if ($searchModel->customer=='1')
                    {
                        return 'Customer GL';
                    }
                    else
                    {
                        return 'Internal GL';
                    }
                }],

            [
            'attribute' =>'leaf',
            'value' => function ($searchModel) {
                if ($searchModel->leaf=='1')
                {
                    return 'Leaf GL';
                }
                else
                {
                    return 'Node GL';
                }
            }],*/

            //'maker_id',
            //'maker_stamptime',
            // 'checker_id',
            // 'checker_stamptime',
            // 'mod_no',
            'balance',
            //'record_status',

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->gl_code];
                        return Html::a('<span class="fa fa-eye"></span>', $url, [
                            'title' => 'View',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },

                ]
            ],

        ],
    ]); ?>
    </div>
</div>
