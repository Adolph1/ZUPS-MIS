<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\growl\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>
<div class="row" style="margin-top: 10px">
    <div class="col-md-1">

    </div>
    <div class="col-md-8">
        <?php

        echo Html::img('uploads/logo-zanzibar.jpg',
            ['width' => '50px', 'height' => '50px', 'class' => 'img-circle']);
        ?>
        <b>ZUPS - MIS</b>
    </div>
    <div class="col-md-3">
Do you have any complain?
        <?php
        Modal::begin([
            'header' => '<h3 class="text text-orange">Tell us about your complain</h3>',
            'toggleButton' => ['label' => ' <i class="fa fa-microphone"></i> Tell us', 'class' => 'btn btn-warning',],
            'size' => Modal::SIZE_LARGE,
            'options' => ['class' => 'slide', 'id' => 'modal-2'],
        ]);
        ?>
        <div class="maoni-kwa-mzee-form" style="margin-left: 10px">

            <?php $form = ActiveForm::begin(['action' => ['complains/create']]); ?>

            <?= $form->field($complaints, 'full_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($complaints, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($complaints, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($complaints, 'notes')->textarea(['rows' => 6]) ?>


            <div class="row">
                <div class="form-group">
                    <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                        <?= Html::submitButton($complaints->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $complaints->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        <?php
        Modal::end();
        ?>

    </div>
</div>
<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
<div class="login-box">
    <div class="text text-info text text-center">
        <!-- Logo -->
        <p><b>Sign to ZUPS - MIS</b></p>


    </div>

    <!-- /.login-logo -->
    <div class="login-box-body" style="margin-bottom: 10px">



        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>


    </div>
    <span class="text text-center" style="margin-left: 80px"><b>Copyright &copy; ZUPS MIS <?= date("Y") ?></b></span>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
    </div>
</div>
