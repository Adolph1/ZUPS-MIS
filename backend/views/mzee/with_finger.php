<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

ini_set("pcre.backtrack_limit", "10000000");
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MzeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wazee');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="mzee-index">


        <?php
        $mkoa = \backend\models\Mkoa::find()->select('id')->where(['zone_id' => \backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wilayas = \backend\models\Wilaya::find()->select('id')->where(['in', 'mkoa_id', $mkoa]);
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],


            /*[
                    'attribute' => 'picha',
                    'filter' => '',
                    'width' => '10px',
                    'value' => function ($model){
                        return "<img src='data:image/png;base64,$model->picha', width='70px' height='70px' align='center' style='vertical-align: middle' class='img-circle'/>";
                    },
                    'format' => ['raw']
            ],*/

            [
                'attribute' => 'majina_mwanzo',
                'label' => 'Mzee',
                'vAlign' => 'middle',
                'width' => '200px',

                // 'filterType' => GridView::FILTER_SELECT2,
                // 'filter' => ArrayHelper::map(\backend\models\Mzee::find()->orderBy('majina_mwanzo')->asArray()->all(), 'majina_mwanzo', 'majina_mwanzo'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    // 'options' => ['multiple' => true]
                ],
                //'filterInputOptions' => ['placeholder' => 'Tafuta kwa majina ya mwanzo'],
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->majina_mwanzo . ' ' . $model->jina_babu), ['view', 'id' => $model->id]);

                }
            ],
            [
                'attribute' => 'msaidizi_id',
                'label' => 'Msaidizi',
                'value' => function ($model) {
                    if ($model->msaidizi_id != null) {
                        return \backend\models\MsaidiziMzee::getFullName($model->msaidizi_id);
                    } else {
                        return '';
                    }
                }
            ],

            [

                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'mzee_finger_print',
                'label' => 'Finger print ya mzee',
                'value' => function ($model) {
                    if ($model->mzee_finger_print != null) {
                        return true;
                    } else {
                        return false;
                    }
                }
            ],

            [

                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'msaidizi_id',
                'label' => 'Finger print ya msaidizi',
                'value' => function ($model) {
                    if ($model->msaidizi_id != null) {
                        return \backend\models\MsaidiziMzee::getFingerPrint($model->msaidizi_id);
                    } else {
                        return false;
                    }
                }
            ],

            [
                'attribute' => 'shehia_id',
                'vAlign' => 'middle',
                'width' => '50px',

                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\backend\models\Shehia::find()->where(['in', 'wilaya_id', $wilayas])->orderBy('jina')->asArray()->all(), 'id', 'jina'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    //'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Tafuta kwa shehia'],
                'value' =>'shehia.jina'
            ],
            [
                'attribute' => 'wilaya_id',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\backend\models\Wilaya::find()->where(['in', 'id', $wilayas])->orderBy('id')->asArray()->all(), 'id', 'jina'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    //'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Tafuta kwa wilaya'],
                'value' => function ($model) {
                    return $model->wilaya->jina;
                }
            ],
            [
                'attribute' => 'kituo_id',
                'hAlign' => 'middle',
                'width' => '50px',
                'contentOptions' => ['class' => 'truncate'],
                // 'noWrap'=>false,

                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\backend\models\Vituo::find()->where(['in', 'wilaya_id', $wilayas])->orderBy('kituo')->asArray()->all(), 'id', 'kituo'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    //'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Tafuta kwa kituo'],
                'value' =>'kituo.kituo'
            ],

            'aliyechukua_finger',
            'tarehe_ya_finger',
            'kidole_code'

        ];


        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
            'pjax' => true,
            'toolbar' => [
                ['content' =>
                // Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
                ],
                '{export}',
                '{toggleData}',
            ],
            // set export properties
            'export' => [
                'fontAwesome' => true
            ],
            'pjaxSettings' => [
                'neverTimeout' => true,
                // 'beforeGrid'=>'My fancy content before.',
                //'afterGrid'=>'My fancy content after.',
            ],
            'panel' => [
                'type' => GridView::TYPE_INFO,
                'heading' => '<strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA WAZEE WALIOCHUKULIWA FINGER PRINT</strong>',
                // 'before' => '<span class="text text-red"> *Eligible*</span>'
            ],
            'persistResize' => false,
            'toggleDataOptions' => ['minCount' => 10],
            // 'exportConfig' => $gridColumns

        ]);


        ?>
    </div>

</div>
<style>
    .truncate {
        max-width: 150px !important;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .truncate:hover {
        overflow: visible;
        white-space: normal;
        width: auto;
    }
</style>