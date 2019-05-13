<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $model backend\models\Budget */

//$this->title = $model->maelezo. ', '.$model->kwa_mwezi. ', '. $model->kwa_mwaka;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Summary ya budget'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-md-10">

    </div>
</div>
<div class="row">
    <div class="col-xs-12 table-responsive">
        <div class="panel panel-info">
            <div class="panel panel-heading">Budget kuu: <?= $model->mwezi;?>, <?= $model->mwaka;?></div>
            <div class="row">
                <div class="col-md-2 text-center"><b>Status:</b> <?= $model->statusLabel;?></div>
                <div class="col-md-2 text-center"><b><?=$model->statusLabel;?> na:</b> <?= \backend\models\ZupsBudgetApproval::getApprovedBY($model->status,$model->id);?></div>
            </div>
            <div class="panel panel-body">
                <div class="panel panel-info">
                    <div class="panel panel-heading">Uendeshaji budget</div>
                    <div class="panel panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Uendeshaji budget</th>
                                <th class="text text-right">Jumla</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $budgets = \backend\models\Budget::find()->where(['status' => \backend\models\Budget::OPEN,'zups_budget_id' => $model->id])->all();
                            $fmt = Yii::$app->formatter;
                            $sum=0;
                            if($budgets != null) {
                                $i = 1;

                                foreach ($budgets as $budget) {
                                    ?>
                                    <tr >
                                        <td><?= $i; ?></td>
                                        <td><?= $budget->zone->jina; ?></td>
                                        <td class="text text-right"><?= $fmt->asDecimal(\backend\models\GharamaMahitaji::getSum($budget->id),2); ?></td>
                                        <td class="text text-right"><?= Html::a('<i class="fa fa-eye"></i>', ['budget/view', 'id' => $budget->id], ['class' => 'btn btn-info']) ?></td>
                                    </tr>
                                    <?php
                                    $sum = $sum + \backend\models\GharamaMahitaji::getSum($budget->id);
                                    $i++;
                                }
                                echo '
                              <tr>
                               <td></td>
                               
                                <td class="text text-right"><b>Jumla ndogo</b></td>
                                 <td class="text text-right"><b>'.$fmt->asDecimal($sum,2).'</b></td>
                                  <td></td>
                                </tr>';
                            }
                            else{
                                echo "No records found";
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel panel-heading">Wazee budget</div>
                    <div class="panel panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Wazee budget</th>
                                <th>Idadi ya wazee</th>
                                <th class="text text-right">Jumla</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $vouchers = \backend\models\Malipo::getWazeeBudget($model->id);
                            $fmt = Yii::$app->formatter;
                            $sum1=0;
                            if($vouchers != null) {
                                $i = 1;

                                foreach ($vouchers as $voucher) {
                                    ?>
                                    <tr >
                                        <td><?= $i; ?></td>
                                        <td><?= $voucher->zone->jina; ?></td>
                                        <td><?= $fmt->asDecimal(\backend\models\Malipo::getTotalPerVoucher($voucher->id)/\backend\models\ZupsProduct::getWazeePension(1),0);?></td>
                                        <td class="text text-right"><?= $fmt->asDecimal(\backend\models\Malipo::find()->where(['voucher_id' => $voucher->id])->sum('kiasi'),2); ?></td>

                                    </tr>
                                    <?php
                                    $sum1 = $sum1 + \backend\models\Malipo::find()->where(['voucher_id' => $voucher->id])->sum('kiasi');
                                    $i++;
                                }
                                echo '
                              <tr>
                               <td></td>
                               <td></td>
                                <td class="text text-right"><b>Jumla ndogo</b></td>
                                 <td class="text text-right"><b>'.$fmt->asDecimal($sum1,2).'</b></td>
                                </tr>';
                            }
                            else{
                                echo "No records found";
                            }
                            ?>

                            </tbody>
                        </table>
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text text-right"><b>Jumla Kuu</b></td>
                                <td class="text text-right"><b><?= $fmt->asDecimal(($sum + $sum1),2);?></b></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">

        </div>

    </div>
</div>
