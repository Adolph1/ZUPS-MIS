<?php


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Mzee */

$this->title = Yii::t('app', 'Fomu ya kuingiza wazee waliofariki');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mzee'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzee-create">
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - FOMU YA KUINGIZA MZEE ALIYEFARIKI</strong>
        </div>

        <div class="col-md-6">


            <?= Html::a(Yii::t('app', '<i class="fa fa-user"></i> Ingiza mzee aliyefariki'), ['new-dead'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-th-list"></i> Orodha ya Wazee waliofariki'), ['died'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>

        </div>
    </div>
    <hr/>
    <?= $this->render('_kufariki_form', [
        'model' => $model,
    ]) ?>

</div>
