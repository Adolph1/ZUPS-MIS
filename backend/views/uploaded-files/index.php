<?php

use backend\models\UploadedFiles;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UploadedFilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uploaded Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploaded-files-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            'uploaded_by',
            'uploaded_date',
            'time_uploaded',
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status == UploadedFiles::PROCESSED){
                        return 'PROCESSED';
                    }elseif($model->status = UploadedFiles::UPLOADED)
                    {
                        return 'UPLOADED';
                    }
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
