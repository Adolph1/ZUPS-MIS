<?php

namespace console\controllers;

use backend\models\KituoShehia;
use backend\models\Malipo;
use backend\models\Mzee;
use backend\models\MsaidiziMzee;
use backend\models\MzeeMsaidiziWengine;
use backend\models\Voucher;
use fedemotta\cronjob\models\CronJob;
use yii\console\Controller;
ini_set('memory_limit','5048M');

/**
 * ServicesController implements the CRUD actions for SmsController model.
 */
class ServicesController extends Controller
{

    /**
     * Run SomeModel::some_method for a period of time
     * @param string $from
     * @param string $to
     * @return int exit code
     */
    public function actionInit($from, $to){
        $dates  = CronJob::getDateRange($from, $to);
        $command = CronJob::run($this->id, $this->action->id, 0, CronJob::countDateRange($dates));
        if ($command === false){
            return Controller::EXIT_CODE_ERROR;
        }else{
            foreach ($dates as $date) {
                //this is the function to execute for each day
                Malipo::getExpired((string) $date);
            }
            $command->finish();
            return Controller::EXIT_CODE_NORMAL;
        }
    }
    /**
     * Run SomeModel::some_method for today only as the default action
     * @return int exit code
     */
    public function actionIndex(){
        return $this->actionInit(date("Y-m-d"), date("Y-m-d"));
    }
    /**
     * Run SomeModel::some_method for yesterday
     * @return int exit code
     */
    public function actionYesterday(){
        return $this->actionInit(date("Y-m-d", strtotime("-1 days")), date("Y-m-d", strtotime("-1 days")));
    }


    public function actionVituo()
    {
        $wazee = Mzee::find()->all();
        foreach ($wazee as $mzee){
            $vituo = KituoShehia::findOne(['shehia_id' => $mzee->shehia_id]);
            if($vituo != null){
                Mzee::updateAll(['kituo_id' => $vituo->kituo_id],['id'=>$mzee->id]);
            }
        }
    }
    
       public function actionCopyDate()
    {
        $wazee = Mzee::find()->where(['!=','mzee_finger_print',''])->all();
        foreach ($wazee as $mzee){
            Mzee::updateAll(['tarehe_ya_finger' => $mzee->muda,'aliyechukua_finger' => $mzee->aliyeweka],['id'=>$mzee->id]);
        }


        $wasaidizi = MsaidiziMzee::find()->where(['!=','finger_print',''])->all();
        foreach ($wasaidizi as $msaidizi){
            MsaidiziMzee::updateAll(['tarehe_ya_finger' => $msaidizi->muda,'aliyechukua_finger'=>$msaidizi->aliyemuweka],['id'=>$msaidizi->id]);
        }

    }

    public function actionDateRecalculation()
    {
        $wazee = Mzee::find()->all();
        foreach ($wazee as $mzee){
            $umri = Mzee::getUmri($mzee->tarehe_kuzaliwa);
            if($umri != null){
                Mzee::updateAll(['umri_sasa' => $umri],['id'=>$mzee->id]);
            }
        }
    }

    public function actionDied()
    {
        $wazee = Mzee::find()->where(['anaishi' => Mzee::DIED])->all();
        foreach ($wazee as $mzee){

                Mzee::updateAll(['status' => Mzee::SUSPENDED],['id'=>$mzee->id]);

        }
    }

    public function actionMzeeId()
    {
        $wazee = Mzee::find()->all();
        foreach ($wazee as $mzee){
            $mzeeId= 'ZUPS/' . date('y') . '/' . sprintf("%05d", $mzee->id + 1);
            Mzee::updateAll(['zups_mzee_id' => $mzeeId],['id'=>$mzee->id]);

        }
    }


    public function actionGenerateVoucher()
    {
        //creates new voucher every month
        Voucher::NewVoucher();
    }

    public function actionVoucherPlanning()
    {
        //voucher planning everyday till the voucher is closed
        Voucher::planEligible();
    }


    public function actionVoucherExpired()
    {
        //creates new voucher every month
        Malipo::makeExpire();
    }
    public function actionExpiredPower()
    {
        $wazee = MzeeMsaidiziWengine::find()->where(['<','valid_date',date('Y-m-d')])->all();
        foreach ($wazee as $mzee){

            MzeeMsaidiziWengine::updateAll(['status' => MsaidiziMzee::INACTIVE],['id'=>$mzee->id]);
            MsaidiziMzee::updateAll(['status' => MsaidiziMzee::INACTIVE],['id' => $mzee->msaidizi_id]);

        }
    }


}
