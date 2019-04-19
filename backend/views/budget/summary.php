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
$searchModel = new \backend\models\GharamaMahitajiSearch();
$dataProvider = $searchModel->searchBYBudgetID($model->id);
$dataProvider->pagination->pageSize=100;

?>
<div class="budget-view">
<hr/>
    <div class="row bg-info">
        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 ">
            <h3>Budget ya mwezi huu</h3>

        </div>


    </div>
<hr/>
    <div class="row">
        <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
        <table class="table table-bordered">
            <thead class="bg-info">
                <th>Budget</th>
                <th class="text text-center">Kiasi</th>
            </thead>
            <tbody class="bg-gray-light">
            <tr>
                <td>
                    Malipo ya wazee

                </td>

                <td class="text text-right"><?= $malipo=\Yii::$app->formatter->asDecimal(\backend\models\Malipo::getCurrentSum(),2);?></td>
            </tr>
            </tr>
            <tr>
                <td>
                    Gharama za uendeshaji
                </td>
                <td class="text text-right"><?= $gharama=\Yii::$app->formatter->asDecimal(\backend\models\GharamaMahitaji::getCurrentSum(),2);?></td>
            </tr>
            <tr class="bg-gray-light">
                <td class="text text-right">
                    <b>Jumla</b>
                </td>
                <td class="text text-right"><?= \Yii::$app->formatter->asDecimal(\backend\models\GharamaMahitaji::getCurrentSum()+\backend\models\Malipo::getCurrentSum(),2);?></td>

            </tr>
            </tbody>
        </table>
        </div>
    </div>
</div>
