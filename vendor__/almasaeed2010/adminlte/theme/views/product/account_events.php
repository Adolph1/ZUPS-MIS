<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 10/17/17
 * Time: 3:38 PM
 */
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

?>

<?= GridView::widget([
    'dataProvider' => $dataEvents,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'event_code',
            'value'=>'eventCode.event_title',

        ],
        'account_role_code',
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute' => 'dr_cr_indicator',
            //'refreshGrid' => true,
            //'format'=>['decimal', 2],
            'editableOptions'=> [
                'header'=>'Name',
                'size'=>'sm',
                'formOptions' => ['action' => ['product-event-entry/edit-gl']],
                'asPopover' => true,
                'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                'data'=>['C'=>'Credit','D'=>'Debit'],
                'options'=>[
                    'pluginOptions'=>['min'=>0, 'max'=>5000]
                ]
            ],
        ],
        'mis_head',

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

                    $url=Yii::$app->urlManager->createUrl(['product-event-entry/delete', 'id' => $dataRoles->id]);
                    return $url;

                }
            }

        ],
    ],

]);
?>


<?php
Modal::begin([
    'header' => '<h2>New Event Form</h2>',
    'toggleButton' => ['label' => 'Add Event','class' => 'btn btn-success'],
    'size' => Modal::SIZE_LARGE,
    'options' => ['class'=>'slide'],
]);
?>
<div class="product-accrole-form">

    <?php $form = ActiveForm::begin([
        'action' => ['product-event-entry/create'],
    ]); ?>

    <?= $form->field($modelevent, 'event_code')->dropDownList(\backend\models\EventType::getAll(),['prompt'=>'--Select--']) ?>
    <?= $form->field($modelevent, 'product_code')->textInput(['value' => $model->product_id,'readonly'=>'readonly']) ?>
    <?= $form->field($modelevent, 'account_role_code')->dropDownList(\backend\models\ProductAccrole::getAll($model->product_id),['prompt'=>'--Select--']) ?>

    <?= $form->field($modelevent, 'dr_cr_indicator')->dropDownList(['C'=>'Credit','D'=>'Debit'],['prompt'=>'--Select--']) ?>


    <div class="form-group">
        <?= Html::submitButton($modelevent->isNewRecord ? 'Create' : 'Update', ['class' => $modelevent->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

Modal::end();
?>
