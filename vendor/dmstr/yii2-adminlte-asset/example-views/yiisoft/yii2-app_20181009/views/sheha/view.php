<?php

use backend\models\ShehaMasaidiziSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Sheha */

$this->title = $model->jina_kamili;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shehas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sheha-view">

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - TAARIFA ZA SHEHA </strong>
        </div>
        <div class="col-md-2">
            <p style="float: left">
                <?php
                Modal::begin([
                    'header' => '<h2 class="lead">Msaidizi wa sheha</h2>',
                    'toggleButton' => ['label' => '<i class="fa fa-user"></i> Ongeza Msaidizi','class' => 'lead btn btn-primary'],
                    'size' => Modal::SIZE_DEFAULT,
                    'options' => ['class'=>'slide'],
                ]);
                ?>
            </p>
            <?php $form = ActiveForm::begin(['action' => ['sheha-masaidizi/create']]); ?>
            <?= $form->field($msaidizi, 'sheha_id')->hiddenInput(['value'=>$model->id])->label(false) ?>

            <?= $form->field($msaidizi, 'jina_kamili')->textInput(['maxlength' => true]) ?>

            <?= $form->field($msaidizi, 'tarehe_kuzaliwa')->widget(DatePicker::ClassName(),
                [
                    //'name' => 'purchase_date',
                    //'value' => date('d-M-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Ingiza Tarehe ya kuzaliwa'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'autoclose'=>true,
                    ]
                ])?>

            <?= $form->field($msaidizi, 'anuani_kamili')->textInput(['maxlength' => true]) ?>

            <?= $form->field($msaidizi, 'nambari_ya_simu')->textInput(['maxlength' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton($msaidizi->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $msaidizi->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>


            <?php ActiveForm::end(); ?>


            <?php

            Modal::end();
            ?>
        </div>
        <div class="col-md-4">


            <?= Html::a(Yii::t('app', '<i class="fa fa-map-marker"></i> Sheha Mpya'), ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Masheha'), ['index'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>

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
            'jina_kamili',
            'mtaa',
            'nyumba_namba',
            'jinsia',
            'simu',
            [
                    'attribute' => 'wilaya_id',
                    'value' => $model->wilaya->jina,
            ],
            'tarehe_kuzaliwa',
            //'shehia_id',
           // 'aliyeweka',
            //'muda',
        ],
    ]) ?>


    <div class="row">
        <div class="col-sm-12">
            <legend class="lead text-blue"><strong>Wasaidizi wa sheha</strong></legend>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
            $searchModel = new ShehaMasaidiziSearch();
            $dataProvider = $searchModel->searchByShahaID($model->id);
            ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'sheha_id',
            'jina_kamili',
            'tarehe_kuzaliwa',
            'anuani_kamili',
             'nambari_ya_simu',
            // 'aliyeweka',
            // 'muda',

            ['class' => 'yii\grid\ActionColumn','header' => 'Actions'],
        ],
    ]); ?>
        </div>
    </div>
</div>
