<?php

use backend\models\KituoShehia;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MalipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Malipos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malipo-index">
    <hr/>
    <div class="row">
        <div class="col-md-12">
            <strong class="lead"  style="color: #01214d;font-family: Tahoma"> <i class="fa fa-check-square text-green"></i> ZUPS - ORODHA YA WAZEE WALIOLIPWA NA WASIOLIPWA KATIKA VITUO MBALI MBALI</strong>
        </div>

    </div>
    <hr/>
    <?php
    if($wilaya != null){
        foreach ($wilaya as $wly){


    ?>
            <div class="lead"><strong>Wilaya ya: <?= $wly->jina; ?> Mwezi wa: <?= date('m');?></strong></div>
    <table class="table table-bordered">
        <thead>
        <th>NA</th>
        <th>KITUO</th>
        <th>SHEHIA</th>
        <th>IDADI YA WALENGWA</th>
        <th>KE</th>
        <th>ME</th>
        <th>WALIOLIPWA</th>
        <th>WASIOLIPWA</th>
        <th>WALIOWAKILISHWA</th>
        <th>WALIOFARIKI</th>
        <th>WASIOLIPWA MWEZI </th>
        <th>WASIOLIPWA MWEZI</th>
        </thead>
        <tbody>
        <?php
        $vituo = \backend\models\Vituo::find()->where(['wilaya_id' => $wly->id])->all();
        if($vituo != null){
            $i=1;
            foreach ($vituo as $kituo){
                echo '<tr>
            <td>'.$i.'</td>
            <td>'.str_replace(',',',<br/>',$kituo->kituo).'</td>';
             echo '<td>';
                $shehias = \backend\models\KituoShehia::find()->where(['kituo_id'=>$kituo->id])->all();
                if($shehias != null){
                   echo '<table>';
                    foreach ($shehias as $shehia){
                        echo '<tr><td>'.$shehia->shehia->jina.'</td></tr>';
                    }
                    echo '</table>';
                }else{
                    echo '';
                }
             echo '</td>';
                echo '<td>';
                if($shehias != null){
                    echo '<table>';
                    foreach ($shehias as $shehia){
                        $malipoShehia = \backend\models\Malipo::find()->where(['shehia_id' => $shehia->shehia_id])->all();
                        echo '<tr><td>'.count($malipoShehia).'</td></tr>';
                    }
                    echo '</table>';
                }else{
                    echo '';
                }
                echo '</td>';
            echo '</tr>';
                $i++;
            }
        }
        ?>
        </tbody>
    </table>
    <?php
        }
    }
    ?>
</div>
