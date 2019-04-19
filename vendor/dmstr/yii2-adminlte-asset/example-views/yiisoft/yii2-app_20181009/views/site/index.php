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
                    <span class="info-box-number"><?= \backend\models\Mzee::getHai();?></span>
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
                    <span class="info-box-number"><?= \backend\models\Mzee::getWaliofariki();?></span>
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
                    <span class="info-box-number"><?= \backend\models\Mzee::getWanaume();?></span>
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
                    <span class="info-box-number"><?= \backend\models\Mzee::getWanawake();?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>

                <h3 class="box-title">ZUPS - WAZEE WENYE FINGER PRINT KATIKA KILA KITO
                </h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <?php
                $searchModel1 = new \backend\models\MzeeSearch();
                $dataProvider1 = $searchModel1->lineChartWithFinger();
                ?>
                <?= \sjaakp\gcharts\ColumnChart::widget([
                    'height' => '400px',
                    'dataProvider' => $dataProvider1,
                    'columns' => [

                        [
                            'attribute'=>'kituo_id',
                            'value' => function($model){
                                if($model->kituo != null) {
                                    return $model->kituo->kituo;
                                }else{
                                    return '';

                                }
                            },

                            'type' => 'string',
                        ],
                        'wazee',





                    ],

                ]) ?>
            </div>
            <!-- /.box-body -->

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>

                <h3 class="box-title">ZUPS - Idadi ya wazee kwa kila kituo</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <?php
                $searchModel1 = new \backend\models\MzeeSearch();
                $dataProvider1 = $searchModel1->lineChart();
                ?>
                <?= \sjaakp\gcharts\ColumnChart::widget([
                    'height' => '400px',
                    'dataProvider' => $dataProvider1,
                    'columns' => [

                        [
                            'attribute'=>'kituo_id',
                            'value' => function($model){
                                if($model->kituo != null) {
                                    return $model->kituo->kituo;
                                }else{
                                    return '';

                                }
                            },

                            'type' => 'string',
                        ],
                        'wazee',





                    ],

                ]) ?>
            </div>
            <!-- /.box-body -->

        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-solid bg-purple-gradient">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>

                <h3 class="box-title">ZUPS - Jumla ya fedha kwa kila kituo mwezi huu</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>

                </div>
            </div>
            <div class="box-body border-radius-none">
                <?php
                $searchModel1 = new \backend\models\MalipoSearch();
                $dataProvider1 = $searchModel1->lineChart();
                ?>
                <?= \sjaakp\gcharts\ColumnChart::widget([
                    'height' => '400px',
                    'dataProvider' => $dataProvider1,
                    'columns' => [

                        [
                            'attribute'=>'kituo_id',
                            'type' => 'string',
                            'value' => function($model){
                                if($model->kituo != null) {
                                    return $model->kituo->kituo;
                                }else{
                                    return '';

                                }
                            },

                        ],

                        'kiasi:number',





                    ],

                ]) ?>
            </div>
            <!-- /.box-body -->

        </div>
    </div>

</div>

</div>
