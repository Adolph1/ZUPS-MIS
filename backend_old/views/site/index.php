<?php

/* @var $this yii\web\View */

$this->title = 'ZUPS - MIS';
?>

<div class="site-index">
<div class="row">
   <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
        <strong class="lead">ZUPS MIS - Dashboard</strong>
    </div>
    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12"></div>
    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12 text-right">
        <strong class="lead"><small> Date: <?= date('Y-m-d');?></small></strong>
    </div>
</div>
    <hr/>
</div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-align-justify"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Wazee Hai</span>
                    <span class="info-box-number">0</span>
                    <span class="info-box-number"><?php // \backend\models\Application::getSeaApps();?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-align-justify"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Waliofariki</span>
                    <span class="info-box-number">0</span>
                    <span class="info-box-number"><?php // \backend\models\Application::getLandApps();?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-align-justify"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Wanaume</span>
                    <span class="info-box-number">0</span>
                    <span class="info-box-number"><?php // \backend\models\Application::getAirApps();?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-align-justify"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Wanawake</span>
                    <span class="info-box-number">0</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

</div>
