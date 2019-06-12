<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BidhaaZilizoingia */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bidhaa Zilizoingias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidhaa-zilizoingia-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'tarehe_ya_kuingia',
            [
                'attribute' => 'bidhaa_id',
                'label' => 'Jina la bidhaa',
                'value' => function ($model){

                    return $model->bidhaa->aina->hitaji;
                }
            ],
            'jina_aliyeleta',
            'idadi',
           // 'jumla',
            'aliyepokea',
            'aliyeingiza',
            'muda',
        ],
    ]) ?>

</div>
