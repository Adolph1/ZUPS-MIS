<?php

namespace console\controllers;

use backend\models\SmsLog;
use Yii;
use yii\console\Controller;


/**
 * SmsController implements the CRUD actions for SmsController model.
 */
class SmsController extends Controller
{

    public function actionSendEmail()
    {
        $emails=SmsLog::find()->where(['status'=>0])->all();



    }


}
