<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use abhimanyu\sms\components\Sms;


/**
 * BGEmailController implements the CRUD actions for BGEmail model.
 */
class SmsController extends Controller
{

    public function actionSendSms()
    {
        $sms = new Sms();

        $carrier = "T-Mobile";
        $number = "+255677309205";
        $subject = "Subject";
        $message = "Test SMS";
        $sms->send($carrier, $number, $subject, $message);
    }


    public function actionEscalationEmail()
    {

    }

}
