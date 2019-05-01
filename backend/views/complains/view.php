<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Complains */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Complains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complains-view">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - COMPLAINT</strong>
        </div>

    </div>
    <hr/>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'id',
            'full_name',
            'email:email',
            'title',
            'notes:ntext',
            'created_date',
            'created_at',
        ],
    ]) ?>

</div>
