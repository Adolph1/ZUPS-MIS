<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model backend\models\UploadedFiles */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Uploaded Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="uploaded-files-view">

    <hr/>
    <div class="panel panel-primary">
        <div class="panel panel-heading">
            <h4>Process</h4>
        </div>
        <div class="panel panel-body">

    <p>


        <?= Html::a('Lipa Maafisa', ['process', 'id' => $model->id], [
            'class' =>$model->status == UploadedFiles::UPLOADED ? 'btn btn-warning enabled':'btn btn-default disabled',
            'data' => [
                'confirm' => 'Unataka kulipa miamala hii?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                        }elseif($model->status == UploadedFiles::UPLOADED)
                        {
                            return 'UPLOADED';
                        }
                    }
            ],
        ],
    ]) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' =>$model->status == UploadedFiles::UPLOADED ? 'btn btn-danger enabled':'btn btn-danger disabled',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
</div>
