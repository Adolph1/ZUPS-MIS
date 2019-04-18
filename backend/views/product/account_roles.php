<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 10/17/17
 * Time: 3:36 PM
 */
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Accrole;
use backend\models\GeneralLedger;
?>

<?= GridView::widget([
    'dataProvider' => $dataRoles,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'account_role',
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute' => 'account_head',
            'refreshGrid' => true,
            //'format'=>['decimal', 2],
            'editableOptions'=> [
                'header'=>'Name',
                'size'=>'md',
                'formOptions' => ['action' => ['product-accrole/edit-gl']],
                'asPopover' => true,
                'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                'data'=>\backend\models\GeneralLedger::getAll(),
                'options'=>[
                    'pluginOptions'=>['min'=>0, 'max'=>5000]
                ]
            ],
        ],
        'status',




        // 'description',

        [
            'class' => 'yii\grid\ActionColumn','header'=>'Actions',
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url, $dataRoles) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,[
                            'title' => Yii::t('app', 'Delete'),
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]


                    );
                },

            ],
            'urlCreator' => function ($action, $dataRoles, $key, $index) {
                if ($action === 'delete') {

                    $url=Yii::$app->urlManager->createUrl(['product-accrole/delete', 'id' => $dataRoles->id]);
                    return $url;

                }
            }

        ],

    ],

]);
?>

<?php
Modal::begin([
    'header' => '<h2>New Role Form</h2>',
    'toggleButton' => ['label' => 'Add Role','class' => 'btn btn-success'],
    'size' => Modal::SIZE_LARGE,
    'options' => ['class'=>'slide'],
]);
?>
<div class="product-accrole-form">

    <?php $form = ActiveForm::begin([
        'action' => ['product-accrole/create'],
    ]); ?>
    <?php
    $accrole=Accrole::find()->all();

    $listaccroles=ArrayHelper::map($accrole,'role_code','role_description');
    $form->field($modelaccrole, 'account_role')->dropDownList(
        $listaccroles,
        ['prompt'=>'Select...']);
    $gls=GeneralLedger::find()->all();

    $listgls=ArrayHelper::map($gls,'gl_code','gl_description');
    $form->field($modelaccrole, 'account_head')->dropDownList(
        $listgls,
        ['prompt'=>'Select...']);

    ?>

    <?= $form->field($modelaccrole, 'account_role')->dropDownList($listaccroles, ['prompt'=>'--Select--']) ?>

    <?= $form->field($modelaccrole, 'product_code')->textInput(['maxlength' => 200,'value'=>$model->product_id]) ?>

    <?= $form->field($modelaccrole, 'account_head')->dropDownList($listgls, ['prompt'=>'--Select--']) ?>

    <?= $form->field($modelaccrole, 'description')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($modelaccrole, 'status')->textInput(['maxlength' => 200]) ?>


    <div class="form-group">
        <?= Html::submitButton($modelaccrole->isNewRecord ? 'Create' : 'Update', ['class' => $modelaccrole->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

Modal::end();
?>
