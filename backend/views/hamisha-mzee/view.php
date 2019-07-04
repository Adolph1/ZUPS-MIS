<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\HamishaMzee */

$this->title = $model->mzee->majina_mwanzo.' '. $model->mzee->jina_babu;
$this->params['breadcrumbs'][] = ['label' => 'Hamisha Mzees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hamisha-mzee-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            //'mzee_id',

            [
                'attribute' => 'mkoa_anaokwenda',
                'value' => function($model){

                    return $model->mkoa->jina;

                }
            ],
            [
                'attribute' => 'wilaya_anayokwenda',
                'value' => function($model){

                    return $model->wilaya->jina;

                }
            ],
            [
                'attribute' => 'shehia_anayokwenda',
                'value' => function($model){

                    return $model->shehia->jina;

                }
            ],

            'sababu',
            [
                'attribute' => 'mkoa_aliotoka',
                'value' => function($model){

                    return $model->fromMkoa->jina;

                }
            ],
            [
                'attribute' => 'wilaya_aliyotoka',
                'value' => function($model){

                    return $model->fromWilaya->jina;

                }
            ],
            [
                'attribute' => 'shehia_aliyotoka',
                'value' => function($model){

                    return $model->fromShehia->jina;

                }
            ],
            'tarehe',
        ],
    ]) ?>

</div>
