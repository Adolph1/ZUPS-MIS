<?php

/* @var $this yii\web\View */
ini_set('memory_limit','1024M');
use kartik\select2\Select2;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\chartjs\ChartJs;
use miloschuman\highcharts\Highcharts;

$this->title = 'ZUPS - MIS';
?>

<div class="site-index" style="font-size: 12px; font-family: Tahoma, sans-serif">
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
            <strong class="lead">ZUPS MIS - Dashboard</strong>
        </div>
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

        </div>
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12 text-right">
            <strong class="lead"><small> Date: <?= date('Y-m-d');?></small></strong>
        </div>
    </div>
    <hr/>
</div>


<div class="row">

    <div class="col-md-6">
        <div class="box box-solid bg-light-blue-gradient ">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>

                <h3 class="box-title">ZUPS - Wanaume Vs wanawake</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <?php
                $searchModel1 = new \backend\models\MzeeSearch();
                $dataProvider1 = $searchModel1->lineAlive();
                ?>
                <?= \sjaakp\gcharts\PieChart::widget([
                    'height' => '200px',
                    'options' => [

                        'colors' => ['#17a2b8', '#ffc107']
                    ],
                    'dataProvider' => $dataProvider1,
                    'columns' => [

                        [
                            'attribute'=>'jinsia',
                            'value' => function($model){
                                if($model->jinsia == 'M') {
                                    return 'Wanaume';
                                }elseif($model->jinsia == 'F'){
                                    return 'Wanawake';

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
        <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>

                <h3 class="box-title">ZUPS - Wazee waliohai Vs waliofariki</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <?php
                $searchModel1 = new \backend\models\MzeeSearch();
                $dataProvider1 = $searchModel1->lineAll();
                ?>
                <?= \sjaakp\gcharts\PieChart::widget([
                    'height' => '200px',
                    'options' => [

                        'colors' => ['#17a2b8', '#28a745']
                    ],
                    'dataProvider' => $dataProvider1,
                    'columns' => [

                        [
                            'attribute'=>'anaishi',
                            'value' => function($model){
                                if($model->anaishi == \backend\models\Mzee::DIED) {
                                    return 'Waliofariki';
                                }elseif($model->anaishi == 1){
                                    return 'Waliohai';

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
    <div class="col-md-12">
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
                <?php echo 'IDADI YA WAZEE WOTE ';
                echo  \backend\models\Mzee::find()->count() ?>
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

</div>
<?php
if(!Yii::$app->user->can('DataClerk')) {
    ?>
    <div class="row">
        <div class="col-md-12">




            <?php
            //  $searchModel1 = new \backend\models\MalipoSearch();
            //   $dataProvider1 = $searchModel1->lineQuaterly();
            ?>
            <?php /* \sjaakp\gcharts\AreaChart::widget([
                                        'height' => '200px',
                                        'dataProvider' => $dataProvider1,
                                        'columns' => [


                                            [
                                                'attribute' => 'kituo_id',
                                                'value' => function ($model) {
                                                    if ($model->kituo_id != null) {
                                                        return $model->kituo->kituo;
                                                    } else {
                                                        return '';

                                                    }
                                                },

                                                'type' => 'string',
                                            ],
                                            'kiasi',


                                        ],

                                    ])*/
            ?>

        </div>

    </div>
    <?php
}
?>
</div>
