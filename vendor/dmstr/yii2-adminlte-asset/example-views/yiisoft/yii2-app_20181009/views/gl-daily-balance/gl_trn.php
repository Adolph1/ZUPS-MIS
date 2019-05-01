<?php
/**
* Created by PhpStorm.
* User: adotech
* Date: 11/1/17
* Time: 9:22 AM
*/
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use backend\models\EventType;
?>
<style>
    #gl-statement {
        box-shadow: 0px 1px 1px 1px #888888;
        padding-top: 5px;padding-bottom: 100px
    }
</style>
<div id="gl-statement">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center text-primary"><h3>GL Account Statement</h3></div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center text-primary"><h3>GL Account : <?= $gl;?></h3></div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center text-primary"><h3>GL Description : <?= \backend\models\GeneralLedger::getDescByGLCODE($gl)?></h3></div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="statement-table" style="margin-left: 10px;">
            <?php
            if($model!=null){
            $balance=0.00;
            echo '<table class="table table-condensed">';
                echo '<tr><th>Date</th><th>Reference</th><th>Description</th><th>Credit</th><th>Debit</th><th>Balance</th></tr>';
                foreach ($model as $statement){
                echo '<tr>';
                    echo '<td>'.$statement->trn_dt.'</td>';
                    echo '<td>'.$statement->trn_ref_no.'</td>';
                    if($statement->event==EventType::INIT){
                    echo '<td>New Transaction</td>';
                    }elseif ($statement->event==EventType::LDS){
                    echo '<td>Disbursement</td>';
                    } elseif ($statement->event==EventType::LQD){
                    echo '<td>Repayment</td>';
                    }
                    elseif ($statement->event==EventType::RVS){
                    echo '<td>Reversal</td>';
                    }else{
                    echo '<td></td>';
                    }
                    if($statement->drcr_ind=='C'){
                    echo '<td>'.$statement->amount.'</td>';
                    echo '<td>0.00</td>';
                    echo '<td>'.$balance=$balance+$statement->amount.'</td>';
                    }elseif ($statement->drcr_ind=='D'){
                    echo '<td>0.00</td>';
                    echo '<td>'.$statement->amount.'</td>';
                    echo '<td>'.$balance=$balance-$statement->amount.'</td>';
                    }
                    echo '</tr>';
                }

                echo '</table>';
            }
            ?>

        </div>
    </div>
    <div class="col-md-12 text-right" style="float: right">
        <?= Html::submitButton(Yii::t('app', '<i class="fa fa-print"></i> Print'), ['class' =>'btn btn-default','id'=>'print-gl']) ?>
    </div>
</div>
