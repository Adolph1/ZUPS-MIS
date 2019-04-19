<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OfficeSupervisor */

$this->title = $model->budget->kumbukumbu_no;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Office Supervisors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="office-supervisor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'aina.matumizi',
            'kiasi',
            'maelezo',
            'budget.kumbukumbu_no',
            'kiambatanisho',
          //  'aliyeweka',
           // 'muda',
        ],
    ]) ?>

</div>
