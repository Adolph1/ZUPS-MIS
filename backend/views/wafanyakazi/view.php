<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\Wafanyakazi */

$this->title = $model->jina_kamili;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wafanyakazi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wafanyakazi-view">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - TAARIFA ZA MFANYAKAZI</strong>
        </div>

        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-user"></i> Mfanyakazi Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Wafanyakazi'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
        <div class="col-md-2">
            <?= Html::a(Yii::t('app', 'Fanya marekebisho'), ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>


        </div>
    </div>


    <div class="row">
        <div class="col-md-8">

        </div>

    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <div class="user-form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= Yii::t('app', 'Taarifa za mfanyakazi'); ?>
                    </div>
                    <div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'jina_kamili',
            'simu',
            'anuani',

        ],
    ]) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="user-form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= Yii::t('app', 'Taarifa za kazi'); ?>
                    </div>
                    <div class="panel-body">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [

                                [
                                    'attribute' => 'department_id',
                                    'value' => function ($model){
                                        if($model->department_id == null){
                                            return ' ';
                                        }else{
                                            return $model->department->jina;
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'mkoa_id',
                                    'value' => function ($model){
                                        if($model->mkoa_id == null){
                                            return ' ';
                                        }else{
                                            return $model->mkoa->jina;
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'wilaya_id',
                                    'value' => function ($model){
                                        if($model->wilaya_id == null){
                                            return ' ';
                                        }else{
                                            return $model->wilaya->jina;
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'report_to',
                                    'value' => function ($model){
                                        if($model->report_to == null){
                                            return ' ';
                                        }else{
                                            return $model->report_to;
                                        }
                                    }
                                ],
                                'aliyeweka',
                                'muda',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(['action'=>['view','id'=>$model->id]]); ?>
        <div class="user-form">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= Yii::t('app', ' Taarifa za kuingia kwenye mfumo'); ?>
                </div>
                <div class="panel-body">


                    <?= $form->field($user, 'username')->textInput(['maxlength' => 255,'readonly'=>'readonly']) ?>
                    <?= $form->field($user, 'role')->dropDownList(User::getArrayRole(),['disabled'=>'disabled']) ?>

                    <?= $form->field($user, 'status')->dropDownList(User::getArrayStatus(),['disabled'=>'disabled']) ?>
                    <?php
                    if(Yii::$app->user->can('admin')) {
                        ?>

                        <?= $form->field($user, 'password')->passwordInput(['maxlength' => 255]) ?>

                        <?= $form->field($user, 'repassword')->passwordInput(['maxlength' => 255]) ?>

                        <div class="form-group">
                            <?= Html::submitButton($user->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Change Password'), ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </div>
    </div>

</div>

