<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TellerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Makarani vituoni');
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-th"></i><strong> ZUPS - ORODHA YA MAKARANI KATIKA VITUO MBALIMBALI</strong></h3>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

               // 'trn_dt',

                [
                    'class'=>'kartik\grid\EditableColumn',
                    'attribute' => 'pay_point_id',
                    'value' => 'payPoint.kituo',
                    'width' => '180px',
                    'refreshGrid' => true,
                    'editableOptions'=> [
                        'header'=>'Badili Kituo',
                        'size'=>'md',
                        'formOptions' => ['action' => ['teller/editkituo']],
                        'asPopover' => true,
                        'inputType'=>\kartik\editable\Editable::INPUT_SELECT2,
                        'data' => \backend\models\Vituo::getAll(),
                        'options'=>[
                            'pluginOptions'=>['min'=>0, 'max'=>5000],

                        ]
                    ],

                ],
                [
                    'attribute' => 'related_customer',
                    'label' => 'Karani',
                    'value' => 'cashier.jina_kamili'
                ],

            ],
        ]); ?>
    </div>
</div>
