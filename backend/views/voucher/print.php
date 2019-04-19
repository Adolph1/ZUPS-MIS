<?php

use backend\models\Malipo;

use yii\helpers\Html;
ini_set('memory_limit','2048M');
?>

<div id="invoice-sec">
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12 text-center">
                <?php
                echo Html::img('uploads/logo-zanzibar.jpg',
                    ['width' => '70px', 'height' => '70px', 'class' => 'img-square']);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h6 class="page-header text-center">
                    SERIKALI YA MAPINDUZI ZANZIBAR<br/>
                    WIZARA YA KAZI, UWEZESHESHAJI, WAZEE, WANAWAKE NA WATOTO<br/>
                </h6>
            </div>
        </div>
        <?php
        $dateObj   = DateTime::createFromFormat('m', date('m'));
        $monthName = $dateObj->format('F'); // March
        if($malipo != null) {
            foreach ($malipo as $mp) {
                ?>
                <p class="text-center"> Universal Pensioners's Pay-List For the Month of <?= $monthName ?>
                    , <?= date('Y'); ?></p>

                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">

                        <address>
                            MKOA: <?= $mp->shehia->wilaya->mkoa->jina; ?><br/>
                            WILAYA: <?= $mp->shehia->wilaya->jina; ?><br/>
                            SHEHIA: <?= $mp->shehia->jina; ?><br/>
                            KITUO: <?= \backend\models\KituoShehia::getName($mp->shehia_id); ?><br/>
                        </address>
                    </div>
                    <div class="break"></div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">

                    </div>
                    <!-- /.col -->
                    <!-- /.col -->
                </div>
                <div class="row" style="page-break-after: always">
                    <div class="col-sm-12">
                        <?php
                        $wazee = Malipo::find()->where(['voucher_id' => $mp->voucher_id, 'shehia_id' => $mp->shehia_id])->all();
                        if($wazee != null){
                            ?>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>JINA LA MZEE</th>
                                    <th>JINA LA MTU WA KARIBU</th>
                                    <th>KIASI</th>
                                    <th>SAINI</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $formatter = \Yii::$app->formatter;
                                $i = 1;
                                $total = 0.00;
                                foreach ($wazee as $wz) {
                                    echo '<tr>
                            <td>'.$i.'</td>
                            <td>'.$wz->mzee->majina_mwanzo.' '.$wz->mzee->jina_babu. '</td>';
                                    if($wz->mzee->msaidizi_id != null){

                                        echo '<td>'.$wz->mzee->msaidizi->jina_kamili.'</td>';
                                    }else{
                                        echo '<td>&nbsp;&nbsp;</td>';
                                    }
                                    ?>
                                    <?php
                                    echo '<td>'.$formatter->asDecimal($wz->kiasi,2).'</td>
                            <td></td>
                            </tr>';
                                    $i++;
                                    $total =$total + $wz->kiasi;

                                }


                                ?>
                                <tr>
                                    <td colspan="3" class="text-right">
                                        <strong>Jumla</strong>
                                    </td>
                                    <td ><strong><?= $formatter->asDecimal($total,2);?></strong></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- /.row -->
                <?php
            }

        }

        ?>





        <!-- /.row -->

    </section>
</div>