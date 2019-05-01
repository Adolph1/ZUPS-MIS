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

<?php
$fmt = Yii::$app->formatter;
?>
<?php
if(Yii::$app->user->can('Cashier')){
    ?>
<div class="row">

    <div class="col-md-6"  style="background: #70777D;margin-left: 10px">
        <h4 style="color: #fff3cd">Mrejesho wa zoezi</h4>
        <div class="block" style="padding-bottom: 10px;color: #FFFFFF">
           <?php
                $lastTransaction = \backend\models\Teller::getTransaction(Yii::$app->user->identity->user_id);
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

                    echo 'Fedha ulizopewa za wazee:' . $fmt->asDecimal(\backend\models\KituoMonthlyBalances::getBalancePerKituoBalance($lastTransaction->pay_point_id), 2);
                    echo '<br/>Fedha ulizowalipa:' . $fmt->asDecimal(\backend\models\KituoMonthlyBalances::getPaidPerKituo($lastTransaction->pay_point_id),2);
                    echo '<br/>Fedha zilizobaki :' . $fmt->asDecimal(\backend\models\KituoMonthlyBalances::getNotPaidPerKituo($lastTransaction->pay_point_id),2);
                }
            }
            ?>

        </div>
    </div>
    <div class="col-md-1"></div>
    <?php

    if(Yii::$app->user->can('Cashier')){

    ?>
    <div class="col-md-2"  style="background: #3b5998">
        <h4 style="color: #FFFFFF">Fedha ulizopewa:</h4>
        <div class="block" style="padding-bottom: 10px;color: #ffb200">


            <p style="color: #FFFFFF;padding-top: 10px">Fedha za wazee:<?= $fmt->asDecimal(\backend\models\Teller::getLastTransactionByUserId(Yii::$app->user->identity->user_id),2);?></p>
            <p style="color: #FFFFFF">Fedha za Watendaji: <?= $fmt->asDecimal(\backend\models\MiamalaWatendaji::getLastTransactionByUserId(Yii::$app->user->identity->user_id),2);?></p>

           <?php
                echo 'Jumla:'. $fmt->asDecimal(\backend\models\AccdailyBal::getCurrentBalance(\backend\models\CashierAccount::geAccountByUserId(Yii::$app->user->identity->user_id)),2);
            }
            ?>
        </div>
    </div>


</div>



