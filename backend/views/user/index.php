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

</div>
<hr>

<div class="user-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'role',
            [
                'attribute' => 'user_id',
                'label' => 'Full name',
                'format' => 'raw',
                'value' => function ($model){
                    return Html::a(Html::encode($model->staff->jina_kamili),['wafanyakazi/view','id'=> $model->user_id]);

                }
            ],
            [
                'label' => 'Zone',
                'value' => 'staff.zone.jina'
            ],
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
            'last_login',
            'login_session',



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
