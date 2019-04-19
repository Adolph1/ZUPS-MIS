<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 10/24/17
 * Time: 12:58 PM
 */

use yii\helpers\Html;
?>
<?php
$searchModel = new \backend\models\TodayEntrySearch();
$dataProvider = $searchModel->searchAllTransactions($model->gl_code);
?>

<div class="row">
    <div class="col-md-12">
        <?= \fedemotta\datatables\DataTables::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'trn_ref_no',
                'trn_dt',
                'ac_no',
                'amount',
                'drcr_ind',
                [
                    'header'=>'Customer Name',
                    'value'=>function($model){
                        return \backend\models\Customer::getFullNameByCustomerNumber($model->related_customer);
                    }
                ],
                'branch.branch_name',
                'value_dt',
                'period_code',
                'finacial_year',
                'auth_stat',

                [
                    'class'=>'yii\grid\ActionColumn',
                    'header'=>'Actions',
                    'template'=>'{view}',
                    'buttons'=>[
                        'view' => function ($url, $model) {
                            if($model->module=='DE'){
                                $path='teller';
                                $id=\backend\models\Teller::getIDByReference($model->trn_ref_no);
                            }elseif($model->module=='LD'){
                                $path='contract-master';
                                $id=$model->trn_ref_no;
                            }
                            $url=[$path.'/view','id' => $id];
                            return Html::a('<span class="fa fa-eye"></span>', $url, [
                                'title' => 'View',
                                'data-toggle'=>'tooltip','data-original-title'=>'Save',
                                'class'=>'btn btn-info',

                            ]);


                        },

                    ]
                ],
            ],
        ]); ?>
    </div>

</div>
