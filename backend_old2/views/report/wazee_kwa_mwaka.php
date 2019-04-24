<?php

use backend\models\WilayaSearch;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MalipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Malipo');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-sitemap text-green"></i><strong> RIPOTI ZA TAKWIMU</strong></h3>
    </div>
</div>
<hr>
<div id="loader1" style="display: none"></div>
<div class="row">
    <div class="col-md-12">
<table class="table table-bordered bg-gray-light">
    <thead>
    <td align="center" valign="center">
        WILAYA
    </td>
    <td>
        <table class="table table-bordered">
            <tr>
                <?php
                $currentMonths = 4;
                for($i=1; $i<=$currentMonths; $i++){
                    if($i == \backend\models\Report::JANUARARI)
                    {
                        $label = 'JANUARARI';
                    }elseif ($i == \backend\models\Report::FEBRUARI){
                        $label = 'FEBRUARI';
                    }
                    elseif ($i == \backend\models\Report::MACHI){
                        $label = 'MACHI';
                    }
                    elseif ($i == \backend\models\Report::APRILI){
                        $label = 'APRILI';
                    }
                    elseif ($i == \backend\models\Report::MEI){
                        $label = 'MEI';
                    }
                    elseif ($i == \backend\models\Report::JUNI){
                        $label = 'JUNI';
                    }
                    elseif ($i == \backend\models\Report::JULAI){
                        $label = 'JULAI';
                    }
                    elseif ($i == \backend\models\Report::AGOSTI){
                        $label = 'AGOSTI';
                    }
                    elseif ($i == \backend\models\Report::SEPTEMBA){
                        $label = 'SEPTEMBA';
                    }
                    elseif ($i == \backend\models\Report::OKTOBA){
                        $label = 'OKTOBA';
                    }
                    elseif ($i == \backend\models\Report::NOVEMBA){
                        $label = 'NOVEMBA';
                    }
                    elseif ($i == \backend\models\Report::DISEMBA){
                        $label = 'DISEMBA';
                    }
                    echo '<td colspan="3" align="center">'.$label.'</td>';
                }
                ?>
            </tr>
            <tr>
            <?php
            $currentMonths = 4;
            for($i=1; $i<=$currentMonths; $i++){
                echo '<td>ME</td><td>KE</td><td>JUMLA</td>';
            }
            ?>
            </tr>
        </table>
    </td>
    </thead>
    <tbody>
    <?php
    $mikoa = \backend\models\Mkoa::find()->select('id')->where(['zone_id' => \backend\models\Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
    $wilays = \backend\models\Wilaya::find()->where(['in','mkoa_id',$mikoa])->all();
    foreach ($wilays as $wilay) {
        ?>
        <tr>
            <td><?= $wilay->jina;?></td>
            <td>
                <table class="table table-bordered">
                    <tr>
                    <?php
                    $currentMonths = 4;
                    for($i=1; $i<=$currentMonths; $i++) {
                        echo '<td>' . \backend\models\Malipo::getMalePerKiwilaya($wilay->id,$i) . '</td><td>' . \backend\models\Malipo::getFemalePerKiwilaya($wilay->id,$i) . '</td>';
                    }
                    ?>
                    </tr>
                </table>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
    </div>

</div>



