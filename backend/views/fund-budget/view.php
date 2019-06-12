<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\FundBudget */

$this->title = $model->budget->kwa_mwezi. '/'. $model->budget->kwa_mwaka;
$this->params['breadcrumbs'][] = ['label' => 'Fund Budgets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fund-budget-view">

 <hr/>
    <div class="panel panel-primary">
        <div class="panel panel-heading">
            <h4>Budget Iliyolipwa</h4>
        </div>
        <div class="panel panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',

            [
                    'attribute' => 'budget_id',
                    'value' => function($model){

                        return $model->budget->kwa_mwezi. '/'. $model->budget->kwa_mwaka;
                    }
            ],
            [
                'attribute' => 'wazee',
                'format' => ['decimal',2]
            ],
            [
                'attribute' => 'uendeshaji',
                'format' => ['decimal',2]
            ],
            [
                'attribute' => 'jumla',
                'format' => ['decimal',2]
            ],
            [
                'attribute' => 'kiasi_kilichotolewa',
                'format' => ['decimal',2]
            ],
            [
                'attribute' => 'bakaa',
                'format' => ['decimal',2]
            ],
            'aliyeingiza',
            'muda',
        ],
    ]) ?>
        </div>
    </div>

</div>
