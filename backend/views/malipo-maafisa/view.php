<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MalipoMaafisa */

$this->title = 'Kumbukumbu Namba: '.$model->kumbukumbu_no;
$this->params['breadcrumbs'][] = ['label' => 'Malipo Maafisa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malipo-maafisa-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            //'budget_id',
            //'zone_id',
            'jina_kamili',
            'kazi',
            'namba_ya_simu',
            'kiasi',
            'tarehe_ya_malipo',
            'kumbukumbu_no',
            'aliyeingiza',
            'muda',
            'ofisi_aliyotoka',
            'kazi_anayoenda_kufanya',
           [
                   'attribute' => 'kituo_id',
                    'value' => function($model){
                        if($model->kituo_id != null){
                            return $model->kituo->kituo;
                        }else{
                            return '';
                        }
                    }
           ],

            [
                'attribute' => 'wilaya_id',
                'value' => function($model){
                    if($model->wilaya_id != null){
                        return $model->kituo->wilaya->jina;
                    }else{
                        return '';
                    }
                }
            ],

            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status == 'R'){
                        return 'Reversal';
                    }else{
                        return '';
                    }
                }
            ],
        ],
    ]) ?>

    <p style="float: right;">
        <?php
        if($model->status != 'R') {
            echo Html::a(Yii::t('app', 'Reverse'), ['reverse', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Unauhakika unataka ku-reverse muamala huu?'),
                    'method' => 'post',
                ],
            ]);
        }?>
    </p>


</div>
