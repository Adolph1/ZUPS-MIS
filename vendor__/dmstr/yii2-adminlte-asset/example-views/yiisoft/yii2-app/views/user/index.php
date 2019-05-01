<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<hr>
<div class="row">
    <div class="col-md-6">
        <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-th-list text-blue"></i> SYSTEM USERS</strong>

    </div>
    <div class="col-md-4">

    </div>
    <div class="col-md-2">

        <?= Html::a(Yii::t('app', '<i class="fa fa-user-plus"></i> Add User'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
    </div>
</div>
<hr>

<div class="user-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            //'email:email',


            //'created_at',

            'role',

            [
                    'attribute'=>'status',
                    'value'=>function ($model){

                        if($model->status==User::STATUS_ACTIVE)
                        {
                            return 'Active';
                        }elseif ($model->status==User::STATUS_DELETED){
                            return 'Disabled';
                        }
                    }

            ],
            /*[
                'attribute' => 'created_at',
                'format' => ['date', 'Y-M-d H:i:s'],
            ],*/

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-pencil"></span>', $url, [
                            'title' => 'View',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-primary',

                        ]);


                    },


                ]
            ],
        ],
    ]); ?>

</div>
