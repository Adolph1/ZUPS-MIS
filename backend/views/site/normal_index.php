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
<?php
$fmt = Yii::$app->formatter;
$lastTransaction = \backend\models\Teller::getTransaction(Yii::$app->user->identity->user_id);
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
<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Jumla ya Wazee</span>
            <span class="info-box-number"><?= Yii::$app->formatter->asDecimal(count(\backend\models\Mzee::getEligible(\backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id))),0)?></span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>


<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Jumla</span>
            <span class="info-box-number">
                <?php
                if($lastTransaction != null) {
                    echo $fmt->asDecimal(\backend\models\AccdailyBal::getCurrentBalance(\backend\models\CashierAccount::geAccountByUserId(Yii::$app->user->identity->user_id)),2);
                }
                ?></span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Fedha za wazee</span>
                <span class="info-box-number">
                <?php
                if($lastTransaction != null) {
                    echo $fmt->asDecimal(\backend\models\KituoMonthlyBalances::getBalancePerKituoBalance($lastTransaction->pay_point_id), 2);
                }
                ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Fedha za Watendaji</span>
                <span class="info-box-number">
                <?php
                if($lastTransaction != null) {
                    echo $fmt->asDecimal(\backend\models\MiamalaWatendaji::getLastTransactionByUserId(Yii::$app->user->identity->user_id),2);
                }
                ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>



<?php
if(Yii::$app->user->can('Cashier')){
    ?>
<div class="row">

    <div class="col-md-6"  style="background: #70777D;margin-left: 10px">
        <h4 style="color: #fff3cd">Mrejesho wa zoezi</h4>
        <div class="block" style="padding-bottom: 10px;color: #FFFFFF">
           <?php

                if($lastTransaction != null) {
                    echo 'Kituo: ' . \backend\models\Vituo::getNameByID($lastTransaction->pay_point_id);

                    echo '<br/>Idadi ya wazee:' . \backend\models\Malipo::getToBePaid($lastTransaction->pay_point_id);
                    echo '<br/>Wazee Waliolipwa:' . \backend\models\Malipo::getPaid($lastTransaction->pay_point_id);
                    echo '<br/>Wazee wasiolipwa:' . \backend\models\Malipo::getNotPaid($lastTransaction->pay_point_id);
                }
            }
            ?>

        </div>

        <div class="block" style="padding: 10px;background: #9ccc65;color: #FFFFFF">
            <?php
            if(Yii::$app->user->can('Cashier')){
                $lastTransaction = \backend\models\Teller::getTransaction(Yii::$app->user->identity->user_id);
                if($lastTransaction != null) {

                    echo '<br/>Fedha ulizowalipa:' . $fmt->asDecimal(\backend\models\KituoMonthlyBalances::getPaidPerKituo($lastTransaction->pay_point_id),2);
                    echo '<br/>Fedha zilizobaki :' . $fmt->asDecimal(\backend\models\KituoMonthlyBalances::getNotPaidPerKituo($lastTransaction->pay_point_id),2);
                }
            }
            ?>

        </div>
    </div>
    <div class="col-md-1"></div>


</div>



