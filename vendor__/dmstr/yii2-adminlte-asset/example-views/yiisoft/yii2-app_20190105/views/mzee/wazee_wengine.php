

 <p style="margin-top: 10px">
                   <?php

                   use kartik\form\ActiveForm;
                   use  kartik\select2\Select2;

                   if($model->anaishi != \backend\models\Mzee::DIED) {


                $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <?=
                        $form->field($model, 'majina_mwanzo')->widget(Select2::classname(), [
                            'data' => \backend\models\Mzee::getAllByMkoa($model->mkoa_id,$model->id),
                            'language' => 'en',
                            'options' => ['placeholder' => 'Chagua mzee ...'],
                            'pluginOptions' => [
                                'allowClear' => true,

                            ],
                        ])->label(false);
                        ?>


                    </div>
            </div>
            <?php ActiveForm::end(); ?>
              <?php


               }
                ?>
               </p>