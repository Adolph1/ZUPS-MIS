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
    <div class="col-xs-12 table-responsive">
        <div class="panel panel-info">
                    <div class="panel panel-heading">Budget kuu ya mwezi huu:</div>
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
                    $budgets = \backend\models\Budget::find()->where(['status' => \backend\models\Budget::OPEN])->all();
                    $fmt = Yii::$app->formatter;
                    if($budgets != null) {
                        $i = 1;
                        $sum=0;
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
                        <th class="text text-right">Jumla</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $vouchers = \backend\models\Malipo::getWazeeBudget();
                    $fmt = Yii::$app->formatter;
                    if($vouchers != null) {
                        $i = 1;
                        $sum1=0;
                        foreach ($vouchers as $voucher) {
                            ?>
                            <tr >
                                <td><?= $i; ?></td>
                                <td><?= $voucher->zone->jina; ?></td>
                                <td class="text text-right"><?= $fmt->asDecimal(\backend\models\Malipo::find()->where(['voucher_id' => $voucher->id])->sum('kiasi'),2); ?></td>

                            </tr>
                            <?php
                            $sum1 = $sum1 + \backend\models\Malipo::find()->where(['voucher_id' => $voucher->id])->sum('kiasi');
                            $i++;
                        }
                        echo '
                              <tr>
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

    <div class="row no-print">
        <div class="col-xs-10"></div>
        <div class="col-xs-2" style="float: right">

                    <?php

                    Modal::begin([
                        'header' => '<h3 class="text text-primary">Sababu za kukataa budget</h3>',
                        'toggleButton' => ['label' => ' <i class="fa fa-times-circle"></i> Kataa', 'class' => 'btn btn-danger',],
                        'size' => Modal::SIZE_LARGE,
                        'options' => ['class' => 'slide', 'id' => 'modal-2'],
                    ]);
                    ?>
                    <div class="maoni-kwa-mzee-form">

                        <?php $form = ActiveForm::begin(['action' => ['rejection-reason/create']]); ?>


                        <?= $form->field($sababu, 'reason')->textarea(['rows' => 6]) ?>


                        <div class="form-group">


                            <?= Html::submitButton($sababu->isNewRecord ? Yii::t('app', 'Kataa Budget') : Yii::t('app', 'Update'), ['class' => $sababu->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                    <?php
                    Modal::end();
                    ?>
            <?php

            echo \yii\helpers\Html::a('<i class="fa fa-check"></i> Kubali', ['approve-invoice', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => 'Are you sure you want to approve this budget?',
                    'method' => 'post',
                ],
            ]);
            ?>

        </div>
    </div>

