<?php

use backend\models\Mzee;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>ZUPS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg margin:200px">
            <?php



            echo Html::img('uploads/logo-zanzibar.jpg',
                ['width' => '40px', 'height' => '40px', 'class' => 'img-circle']);
            ?>
            ZUPS - MIS
            </span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>

            <?php
            if (!Yii::$app->user->isGuest) {
                echo 'Cheo: ';
                echo Yii::$app->user->identity->role;
                echo ' @ ';
                echo \backend\models\Zone::getZoneNameByuserId(Yii::$app->user->identity->user_id);
            }?>
        </a>

        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8" style="margin-top: 10px">

            <?php
            $url = \yii\helpers\Url::to(['mzee/wazee']);
            $model = new Mzee();
            $cityDesc = empty($model->mzee_details) ? '' : Mzee::find()->where(['jina_babu' => $model->majina_mwanzo])->orWhere(['or','jina_babu' => $model->jina_babu])->one();

                $form = ActiveForm::begin();
            echo $form->field($model, 'mzee_details')->widget(Select2::classname(), [
                'initValueText' => $cityDesc, // set the initial display text
                'options' => ['placeholder' => 'Tafuta mzee ...','id' => 'search-mzee'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Subiri kidogo..'; }"),
                    ],
                    'ajax' => [
                        'url' => $url,
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(mzee) { return mzee.text + " " + mzee.last; }'),
                    'templateSelection' => new JsExpression('function (mzee) { return mzee.text}'),
                ],
            ])->label(false);
            ActiveForm::end();

            ?>

        </div>


        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Languages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->

                    <ul class="dropdown-menu">

                        <li>
                            <!-- inner menu: contains the messages -->
                            <ul class="menu">


                            </ul><!-- /.menu -->
                        </li>

                    </ul>
                </li><!-- /.Languages-menu -->
                <?php
                if (!Yii::$app->user->isGuest && (Yii::$app->User->can('admin')||Yii::$app->User->can('PensionOfficer') ||Yii::$app->User->can('HQ-PensionOfficer') ||Yii::$app->User->can('DataClerk'))) {
                    //echo Yii::$app->user->identity->username;

                    ?>
                    <!-- Messages: style can be found in dropdown.less-->

                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user-plus text-black"></i>
                            <?php
                            $sms = ' Hakuna mzee mpya';
                            $incart=\backend\models\Mzee::getApplied();
                            if($incart == 1){
                                $sms = 'Kuna mzee ' .$incart.  ' ambae ni mpya';
                            }elseif ($incart > 1){
                                $sms = 'Kuna wazee ' .$incart.  ' ambao ni wapya';
                            }
                            if($incart>0) {
                                ?>
                                <span class="label label-warning"><?= $incart; ?></span>
                                <?php
                            }
                            ?>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="header"><i class="fa fa-th text-aqua"></i> <?= $sms;?></li>
                            <?php
                            if($incart>0){
                                echo  '<li><div class="col-sm-12 text-center" style="padding: 10px">'.Html::a(Yii::t('app', 'Fungua'), ['mzee/pending'], ['class' => 'btn btn-primary']).'</div></li>';
                            }
                            ?>

                        </ul>

                    </li><!-- /.messages-menu -->
                                             <!-- Messages: style can be found in dropdown.less-->

                                             <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o text-black"></i>
                            <?php
                            $sms1 = ' Hakuna mzee anaehitaji uhakiki';
                            $vetted=\backend\models\Mzee::getVetted();
                            if($vetted == 1){
                                $sms1 = 'Kuna mzee ' .$vetted.  ' anaehitaji kukubaliwa';
                            }elseif ($vetted > 1){
                                $sms1 = 'Kuna wazee ' .$vetted.  ' Wanaohitaji kukubaliwa';
                            }
                            if($vetted>0) {
                                ?>

                                <span class="label label-warning"><?= $vetted; ?></span>
                                <?php
                            }
                            ?>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="header"><i class="fa fa-th text-aqua"></i><?= $sms1;?> </li>
                            <?php
                            if($vetted>0){
                                echo  '<li><div class="col-sm-12 text-center" style="padding: 10px">'.Html::a(Yii::t('app', 'Fungua'), ['mzee/vetted'], ['class' => 'btn btn-primary']).'</div></li>';
                            }
                            ?>

                        </ul>

                    </li><!-- /.messages-menu -->
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bullhorn text-black"></i>
                            <?php
                            $sms2 = ' Hakuna mzee aliyetimiza miaka 70';
                            $seventy=\backend\models\Mzee::getWithSeventy();
                            if($seventy == 1){
                                $sms2 = 'Kuna mzee ' .$seventy.  ' aliyetimiza miaka 70';
                            }elseif ($seventy > 1){
                                $sms2 = 'Kuna wazee ' .$seventy.  ' waliotimiza miaka 70';
                            }
                            if($seventy>0) {
                                ?>
                                <span class="label label-warning"><?= $seventy; ?></span>
                                <?php
                            }
                            ?>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="header"><i class="fa fa-th text-aqua"></i> <?= $sms2;?></li>
                            <?php
                            if($seventy>0){
                                echo  '<li><div class="col-sm-12 text-center" style="padding: 10px">'.Html::a(Yii::t('app', 'Fungua'), ['mzee/with-seventy'], ['class' => 'btn btn-primary']).'</div></li>';
                            }
                            ?>

                        </ul>

                    </li><!-- /.messages-menu -->
                                                                                          <!-- Messages: style can be found in dropdown.less-->
                <?php }?>


                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">
                                <?php
                                if (!Yii::$app->user->isGuest) {
                                    echo 'Habari, '. Yii::$app->user->identity->username;
                                }
                                ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="http://placehold.it/160x160" class="img-circle" alt="User Image">
                            <p>
                                <?php
                                if (!Yii::$app->user->isGuest) {

                                    echo Yii::$app->user->identity->username;
                                    $user_id=Yii::$app->user->identity->id;
                                }

                                ?>

                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?php
                                if(!Yii::$app->user->isGuest) {
                                    $user_id=Yii::$app->user->identity->id;
                                    echo Html::beginForm(['/user/profile','id' => $user_id], 'post');
                                    echo Html::submitButton(
                                        'My profile',
                                        ['class' => 'btn btn-link logout']
                                    );
                                    echo Html::endForm();
                                }?>
                            </div>
                            <div class="pull-right">
                                <?php
                                if(!Yii::$app->user->isGuest) {
                                    echo Html::beginForm(['/site/logout'], 'post');
                                    echo Html::submitButton(
                                        'Logout (' . Yii::$app->user->identity->username . ')',
                                        ['class' => 'btn btn-link logout']
                                    );
                                    echo Html::endForm();
                                }
                                ?>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
