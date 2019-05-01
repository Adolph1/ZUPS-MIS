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
    <?php
    $budget = \backend\models\Budget::getLatestBudget();
    ?>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Jumla ya Eligible</span>
                <span class="info-box-number"><?= Yii::$app->formatter->asDecimal(count(\backend\models\Mzee::getEligible(\backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id))),0)?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Budget ya mwezi huu</span>
                <span class="info-box-number"><?= Yii::$app->formatter->asDecimal($budget->jumla_kiasi,2);?></span>
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
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Wazee</span>
                <span class="info-box-number"><?= Yii::$app->formatter->asDecimal($budget->wazee,2);?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-gear"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Uendeshaji</span>
                <span class="info-box-number"><?= Yii::$app->formatter->asDecimal($budget->uendeshaji,2);?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<div class="row">
    <?php
    $budget = \backend\models\Budget::getLatestBudget();
    ?>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua-gradient"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Waliolipwa mwezi huu</span>
                <span class="info-box-number"><?= Yii::$app->formatter->asDecimal(\backend\models\Malipo::getPaidPerZone(),0);?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua-gradient"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Wasiolipwa mwezi huu</span>
                <span class="info-box-number"><?= Yii::$app->formatter->asDecimal(\backend\models\Malipo::getNotPaidPerZone(),0);?></span>
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
            <span class="info-box-icon bg-aqua-gradient"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Fedha Zilizolipwa</span>
                <span class="info-box-number"><?= Yii::$app->formatter->asDecimal(\backend\models\Malipo::getTotalPaidPerZone(),2);?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua-gradient"><i class="fa fa-gear"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Fedha Zilizobaki</span>
                <span class="info-box-number"><?= Yii::$app->formatter->asDecimal(\backend\models\Malipo::getTotalNotPaidPerZone(),2);?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<div class="row">
    <div class="col-md-9">
        <div>
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>

                <h3 class="box-title">ZUPS - Miamala ya makashia kwa ajili ya wazee</h3>

            </div>
            <div class="box-body border-radius-none">
                <?php
                $searchModel2 = new \backend\models\TellerSearch();
                $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);
                ?>
                <?= \fedemotta\datatables\DataTables::widget([
                    'dataProvider' => $dataProvider2,
                    'filterModel' => $searchModel2,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],


                        [
                            'attribute' => 'trn_dt',

                        ],
                        [
                            'attribute' => 'related_customer',
                            'label' => 'Karani',
                            'value' => 'cashier.jina_kamili'
                        ],

                        [
                            'attribute' => 'amount',
                            'format' => ['decimal',2],

                        ],

                        'month',
                        [
                            'attribute' => 'pay_point_id',
                            'value' => 'payPoint.kituo'
                        ],




                    ],
                    'clientOptions' => [
                        "lengthMenu"=> [[100,-1], [100,Yii::t('app',"All")]],
                        "info"=>false,
                        "responsive"=>true,
                        "dom"=> 'lfTrtip',
                        "tableTools"=>[
                            "aButtons"=> [
                                [
                                    "sExtends"=> "copy",
                                    "sButtonText"=> Yii::t('app',"Copy to clipboard")
                                ],[
                                    "sExtends"=> "csv",
                                    "sButtonText"=> Yii::t('app',"Save to CSV")
                                ],[
                                    "sExtends"=> "xls",
                                    "oSelectorOpts"=> ["page"=> 'current']
                                ],[
                                    "sExtends"=> "pdf",
                                    "sButtonText"=> Yii::t('app',"Save to PDF")
                                ],[
                                    "sExtends"=> "print",
                                    "sButtonText"=> Yii::t('app',"Print")
                                ],
                            ]
                        ]
                    ],
                ]); ?>
            </div>
            <!-- /.box-body -->

        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-bank"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Jumla ya Bajeti</span>
                <span class="info-box-number"><?= Yii::$app->formatter->asDecimal(\backend\models\Budget::getClosingBudget(),2);?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-check"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Iliyotumika mpaka sasa</span>
                <span class="info-box-text"><?= Yii::$app->formatter->asDecimal(\backend\models\Budget::getTotalPaidBalance(),2);?></span>
                <div class="progress">
                    <?php if(\backend\models\Budget::getClosingBudget() != 0.00) {?>
                    <div class="progress-bar" style="width: <?= Yii::$app->formatter->asDecimal(100*\backend\models\KituoMonthlyBalances::getPaidPerZone($budget->zone_id,$budget->kwa_mwezi,$budget->kwa_mwaka)/\backend\models\Budget::getClosingBudget(),2);?>">%</div>
                        <?php
                    }
                    ?>
                </div>

                <span class="progress-description">
                    <?php
                    $latestBudget = \backend\models\Budget::getLatestBudget();
                    if(\backend\models\Budget::getClosingBudget() != 0.00) {
                        ?>
                        Sawa na Asilimia <?= Yii::$app->formatter->asDecimal(100 * \backend\models\Budget::getTotalPaidBalance() / \backend\models\Budget::getClosingBudget(), 2); ?>
                        <?php
                    }
                    ?>
                  </span>

            </div>
            <!-- /.info-box-content -->
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
