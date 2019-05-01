<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reports');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Report'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'report_name',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->report_name),[$data->path]);
                },
            ],
            [
                    'attribute'=>'module',
                    'value'=>'moduleName.module_name'
            ],
            [
                'attribute'=>'status',
                'value'=>function ($data){
                if($data->status==1){
                    return "Active";
                }
                elseif ($data->status==0){

                    return "Disabled";
                }
                }
            ],


            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
