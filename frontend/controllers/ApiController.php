<?php

namespace frontend\controllers;


use backend\models\AccdailyBal;
use backend\models\Audit;
use backend\models\CashierAccount;
use backend\models\ClerkKituo;
use backend\models\EventType;
use backend\models\GlDailyBalance;
use backend\models\KituoCashier;
use backend\models\KituoMonthlyBalances;
use backend\models\KituoShehia;
use backend\models\MahesabuYaliofungwa;
use backend\models\Malipo;
use backend\models\MsaidiziMzee;
use backend\models\Mzee;
use backend\models\ProductAccrole;
use backend\models\Shehia;
use backend\models\Teller;
use backend\models\TodayEntry;
use backend\models\User;
use backend\models\UserSearch;
use backend\models\Vituo;
use backend\models\Wafanyakazi;
use common\models\LoginForm;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * ApiController implements the CRUD actions for Api model.
 */
class ApiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }




    //fetches mzee details by Zanzibar ID
    public function actionSearch($zid)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        //$msaidiz = MsaidiziMzee::find()->select('jina_kamili','id')->where(['status' => MsaidiziMzee::ACTIVE,'mzee_id'=>$zid]);
        $mzee = Mzee::find()->select("id,majina_mwanzo,jina_babu,umri_sasa,status,msaidizi_id")->where(['nambar' => $zid,])->one();


        if($mzee != null )

        {
            $msaidiz =MsaidiziMzee::find()->where(['id' =>$mzee->msaidizi_id])->one();
            if($msaidiz != null) {
                return array('success' => true, 'data' => $mzee,'msaidizi' => $msaidiz);
            }else{
                return array('success' => true, 'data' => $mzee,'msaidizi' => 'Hana Msaidizi');
            }

        }

        else

        {

            return array('success'=>false,'data'=> 'No Mzee Found');

        }

    }

    //fetches mzee details by Zanzibar ID
    public function actionWazee($id)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;


        $query = new Query();
        $query	->select(['b.id',
            'b.majina_mwanzo',
            'b.jina_babu',
            'b.jina_maarufu',
            'b.jinsia',
            'b.tarehe_kuzaliwa',
            'b.umri_sasa',
            'b.mzawa_zanzibar',
            'b.aina_ya_kitambulisho',
            'b.nambar',
            'b.mkoa_id',
            'b.wilaya_id',
            'b.shehia_id',
            'b.kituo_id',
            'b.mtaa',
            'b.status',
            'b.anaishi',
            'b.tarehe_kufariki',
            'b.mzee_finger_print',
            'b.msaidizi_id',
            'b.aina_ya_msaidizi',
            'b.zups_mzee_id','d.jina as aina_ya_kitambulisho','a.jina_kamili as mtu_karibu','c.jina as aina_ya_kitambulisho_mtu_karibu','a.nambari_ya_kitambulisho','a.finger_print as mtu_karibu_finger_print','a.tarehe_mwisho_power'])
            ->from('tbl_mzee b')
            ->leftJoin('tbl_msaidizi_mzee a', 'b.msaidizi_id = a.id')
            ->leftJoin('tbl_aina_ya_kitambulisho c', 'a.aina_ya_kitambulisho = c.id')
            ->leftJoin('tbl_aina_ya_kitambulisho d', 'b.aina_ya_kitambulisho = d.id')
            ->where(['b.kituo_id' => $id]);


        $command = $query->createCommand();
        $wazee = $command->queryAll();



        if(count($wazee) > 0 )
        {

            return array('success' => true, 'data'=> $wazee);

        }

        else

        {

            return array('success'=>false,'data'=> 'No Mzee Found');

        }

    }





    ///list of shehias

    public function actionVituo()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $vituo = Vituo::find()->select("id,kituo")->all();

        if(count($vituo) > 0 )

        {

            return array('success' => true, 'data'=> $vituo);

        }

        else

        {

            return array('success'=>false,'data'=> 'No Kituo Found');

        }

    }

    public function actionClearFinger($mzee_id,$type)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        if($type == 1){
            $mzee = Mzee::findOne($mzee_id);
            if($mzee !=null){
                Mzee::updateAll(['mzee_finger_print' => null],['id' => $mzee->id]);
                $flag =1;
            }else{
                return array('success'=>false,'data'=> 'Hatuna mzee kama huyo');
            }

        }elseif($type ==2){
            $mzee = Mzee::findOne($mzee_id);
            MsaidiziMzee::updateAll(['finger_print' => null],['id'=>$mzee->msaidizi_id]);
            $flag = 1;
        }


        if( $flag == 1 )

        {

            return array('success' => true, 'data'=> 'Successfully updated');

        }

        else

        {

            return array('success'=>false,'data'=> 'Failed to update');

        }


    }


    ///list of kituo
    public function actionChangeKituo($user_id,$kituo)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $clerk = ClerkKituo::find()->where(['user_id' => $user_id])->orderBy(['id' => SORT_DESC])->one();

        if($clerk != null )

        {
            if(ClerkKituo::updateAll(['kituo_id' => $kituo],['id' => $clerk->id])) {

                return array('success' => true, 'data' => 'Successfully changed the paypoint');
            }else{
                return array('success'=>false,'data'=> 'No changes made');
            }

        }

        else

        {
            $kituoclerk = new ClerkKituo();
            $kituoclerk->user_id = $user_id;
            $kituoclerk->date_assigned = date('Y-m-d');
            $kituoclerk->kituo_id = $kituo;
            $kituoclerk->maker_id = User::getUsernameByUserId($user_id);
            $kituoclerk->maker_time = date('Y-m-d H:i:s');
            $kituoclerk->status = 1;
            $kituoclerk->save();

            return array('success' => true, 'data' => 'Successfully changed the paypoint');

        }

    }



    ///list of shehias

    public function actionShehia($id)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $shehia = KituoShehia::find()->select('shehia_id')->where(['kituo_id' => $id]);

        $shehia = Shehia::find()->select("id,jina")->where(['in','id',$shehia])->all();

        if(count($shehia) > 0 )

        {

            return array('success' => true, 'data'=> $shehia);

        }

        else

        {

            return array('success'=>false,'data'=> 'No shehia Found');

        }

    }


    //complete registration by finger print
    public function actionRegisterFinger()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        if(Yii::$app->request->post()) {
            $mzee_id = Yii::$app->request->post('id');
            $fingerprint = Yii::$app->request->post('fingerprint');
            $user_id = Yii::$app->request->post('user_id');
            $username = User::getUsernameByUserId($user_id);
            $type = Yii::$app->request->post('type');
            $mzee_image = Yii::$app->request->post('image');
            $date = Yii::$app->request->post('date');
            $fingerCode = Yii::$app->request->post('fingerCode');


<<<<<<< HEAD
            if ($type == 2) {
                $mzee = Mzee::findOne($mzee_id);
                if ($mzee != null) {
                    Mzee::updateAll(['mzee_finger_print' => $fingerprint, 'kidole_code' => $fingerCode, 'picha' => $mzee_image, 'aliyechukua_finger' => $username, 'tarehe_ya_finger' => $date], ['id' => $mzee_id]);
                    $flag = 1;
                } else {
                    //return array('success'=>false,'data'=> 'Hatuna mzee kama huyo');
=======
>>>>>>> ca4906fb2036137392ccfaa209da31894906c1a8
                    if ($type == 2) {
                        $mzee = Mzee::findOne($mzee_id);
                        if ($mzee != null) {
                            Mzee::updateAll(['mzee_finger_print' => $fingerprint, 'kidole_code' => $fingerCode, 'picha' => $mzee_image, 'aliyechukua_finger' => $username, 'tarehe_ya_finger' => $date], ['id' => $mzee_id]);
                            $flag = 1;
                        } else {
                            return array('success' => false, 'data' => 'Hatuna mzee kama huyo');
                        }

                    } elseif ($type == 1) {
                        $mzee = MsaidiziMzee::findOne($mzee_id);
                        MsaidiziMzee::updateAll(['finger_print' => $fingerprint, 'kidole_code' => $fingerCode, 'picha' => $mzee_image, 'aliyechukua_finger' => $username, 'tarehe_ya_finger' => $date], ['id' => $mzee->id]);
                        $flag = 1;
                    }


                    if ($flag == 1) {

                        return array('success' => true, 'data' => 'Successfully updated');

                    } else {

                        return array('success' => false, 'data' => 'Failed to update');
<<<<<<< HEAD

                    }
                }
=======

                    }

            }else{
                return array('success' => false, 'data' => 'Failed to update');
>>>>>>> ca4906fb2036137392ccfaa209da31894906c1a8
            }

                } else{
                    return array('success' => false, 'data' => 'Failed to update');
                }

    }



    public function actionReceivePayment($trn_id,$cashier_id,$remark,$payee_type,$verification_type)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;


        $malipo = Malipo::findOne($trn_id);
        if($malipo->status == Malipo::PAID) {
            return array('success' => false, 'error_code' => 300,'error'=> 'Already paid');
        }else{
            $malipo->status = Malipo::PAID;
            $malipo->cashier_id = $cashier_id;
            $malipo->tarehe_kulipwa = date('Y-m-d');
            $malipo->remarks = $remark;
            $malipo->payee_type = $payee_type;
            $malipo->verification_type = $verification_type;
            if($payee_type == 1) {
                $malipo->aliyelipwa = 'Mzee';
            }elseif($payee_type == 2){
                $malipo->aliyelipwa = 'Msaidizi';
            }

            $cashierBalance = AccdailyBal::getCurrentBalance(CashierAccount::geAccountByUserId($cashier_id));
            if($cashierBalance >= $malipo->kiasi) {

                if ($malipo->save()) {


                    //saves customer leg
                    TodayEntry::saveEntry(
                        $module = 'DE',
                        'CSHD' . $malipo->mzee_id . date('ymd') . $malipo->id,
                        date('Y-m-d'),
                        CashierAccount::geAccountByUserId($cashier_id),
                        Wafanyakazi::getZoneByID($cashier_id),
                        $malipo->kiasi,
                        $ind = 'D',
                        Wafanyakazi::getFullnameByUserId($cashier_id),
                        'BCSH',
                        date('Y-m-d'),
                        EventType::INIT,
                        User::getUsernameByUserId($cashier_id)
                    );

                    AccdailyBal::updateAccountBalance(CashierAccount::geAccountByUserId($cashier_id), $malipo->kiasi, 'D');

                    //saves customer leg
                    TodayEntry::saveEntry(
                        $module = 'DE',
                        'CSHD' . $malipo->mzee_id . date('ymd') . $malipo->id,
                        date('Y-m-d'),
                        $malipo->mzee->majina_mwanzo . ' ' . $malipo->mzee->jina_babu . ' - ' . $malipo->mzee_id,
                        Wafanyakazi::getZoneByID($cashier_id),
                        $malipo->kiasi,
                        $ind = 'C',
                        Wafanyakazi::getFullnameByUserId($cashier_id),
                        'BCSH',
                        date('Y-m-d'),
                        EventType::INIT,
                        User::getUsernameByUserId($cashier_id)
                    );


                    TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => User::getUsernameByUserId($cashier_id), 'checker_time' => date('Y-m-d H:i:s')], ['trn_ref_no' => 'CSHD' . $malipo->mzee_id . date('ymd') . $malipo->id, 'auth_stat' => 'U']);


                    KituoMonthlyBalances::updateMonthlyBalance($malipo->kituo_id, $malipo->voucher->mwezi, $malipo->voucher->mwaka, $malipo->kiasi, $cashier_id);

                    return array('success' => true, 'data' => 'Successfully Paid');
                } else {
                    return array('success' => false, 'data' => 'Failed to update');
                }
            }else{

                Audit::setActivity('Malipo hayajakamilika kwa kuwa account ya cashier('.User::getUsernameByUserId($cashier_id).' - '.CashierAccount::geAccountByUserId($cashier_id).') haina pesa ya kutosha','Malipo','Payment','','');
                return array('success' => false, 'data' => 'Cashier account has no sufficient balance');


            }

        }

    }


    //fetches all payments
    public function actionPayments($id)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $shehias = KituoShehia::find()->select('shehia_id')->where(['kituo_id' => $id]);

        $malipo = Malipo::find()->select("id,mzee_id,shehia_id,kiasi,siku_kwanza,siku_pili,siku_mwisho,status")->where(['in','shehia_id',$shehias])->andWhere(['status' => Malipo::PENDING])->all();

        if(count($malipo) > 0 )

        {

            return array('success' => true, 'data'=> $malipo);

        }

        else

        {

            return array('success'=>false,'data'=> 'No Payments Found');

        }

    }

    //fetches all pending payments
    public function actionGetPending($cashier)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $user = User::find()->where(['user_id' => $cashier])->one();
        if($user != null) {


            $pendings = Teller::find()->where(['status' => 'U','related_customer' => $cashier])->all();

            if (count($pendings) > 0) {

                return array('success' => true, 'data' => $pendings);

            } else {

                return array('success' => false, 'data' => 'No Payments Found');

            }

        }else{
            return array('success' => false, 'data' => 'No such cashier');
        }

    }
    //cancel trasaction

    public function actionCancel($id)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $model = Teller::findOne($id);
        if ($model != null) {
            if ($model->status == 'C') {
                return array('success' => true, 'data' => 'has already Cancelled');
            } elseif($model->status == 'U') {

                Teller::updateAll(['status' => 'C'],['id' => $model->id]);
                return array('success' => true, 'data' => 'Transaction has been Cancelled successfully');

            }else{

                return array('success' => false, 'data' => 'Failed');
            }
        }
    }

    //change password

    public function actionChangePassword()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        if(Yii::$app->request->post()) {
            $username = Yii::$app->request->post('username');
            $oldpass = Yii::$app->request->post('old_password');
            $password = Yii::$app->request->post('new_password');
            $model = User::findOne(['username' => $username]);
            if ($model->validatePassword($oldpass)) {
                $model->password_hash = Yii::$app->security->generatePasswordHash($password);
                if ($model->save(false)) {
                    return array('success' => true, 'data' => 'Successfully updated');
                } else {
                    return array('success' => false, 'data' => 'Failed to change password');
                }
            }else{
                return array('success' => false, 'data' => 'wrong old password provided');
            }
        }else {
            return array('success' => true, 'data' => 'Nothing is posted');
        }


    }

    public function actionApprove($id)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $model=Teller::findOne($id);
        if($model != null){
            if($model->status == 'A'){
                return array('success' => true, 'data' => 'has already confirmed');
            }else{

                $model->checker_id=User::getUsernameByUserId($model->related_customer);
                $model->checker_time = date('Y-m-d H:i:s');
                $model->status='A';
                $gLbalance = GlDailyBalance::getCurrentBalance($model->offset_account);
                //$model->save();

                if($gLbalance >= $model->amount) {
                    if ($model->save()) {
                        $role_events = ProductAccrole::getRoleEvents($model->product, $event = EventType::INIT);
                        if ($role_events != null) {
                            foreach ($role_events as $role_event) {
                                if ($role_event->dr_cr_indicator == 'C') {


                                    //saves customer leg
                                    TodayEntry::saveEntry(
                                        $module = 'DE',
                                        $model->reference,
                                        date('Y-m-d'),
                                        $model->txn_account,
                                        Wafanyakazi::getZoneByID($model->related_customer),
                                        $model->amount,
                                        $ind = 'C',
                                        Wafanyakazi::getFullnameByUserId($model->related_customer),
                                        $model->product,
                                        date('Y-m-d'),
                                        $event,
                                        $model->maker_id
                                    );

                                    //updates customer account balance

                                    AccdailyBal::updateAccountBalance($model->txn_account, $model->amount, 'C');


                                } elseif ($role_event->dr_cr_indicator == 'D') {

                                    //saves GL leg
                                    TodayEntry::saveEntry(
                                        $module = 'DE',
                                        $model->reference,
                                        date('Y-m-d'),
                                        $role_event->mis_head,
                                        Wafanyakazi::getFullnameByUserId($model->related_customer),
                                        $model->amount,
                                        $ind = 'D',
                                        $model->related_customer,
                                        $model->product,
                                        date('Y-m-d'),
                                        $event,
                                        $model->maker_id
                                    );


                                    GlDailyBalance::updateGLBalance($role_event->mis_head, $model->offset_amount, 'D');



                                }
                            }
                        }
                        TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->checker_id, 'checker_time' => $model->checker_time], ['trn_ref_no' => $model->reference, 'auth_stat' => 'U']);

                        $monthlyBalance = new MahesabuYaliofungwa();
                        $monthlyBalance->kituo_id = $model->pay_point_id;
                        $monthlyBalance->kiasi_alichopewa = $model->amount;
                        $monthlyBalance->kiasi_alichorudisha = 0.00;
                        $monthlyBalance->kiasi_kilichobaki = 0.00;
                        $monthlyBalance->kiasi_kilichotumika = 0.00;
                        $monthlyBalance->cashier_id = $model->related_customer;
                        $monthlyBalance->tarehe_ya_kupewa = date('Y-m-d');
                        $monthlyBalance->trn_id = $model->id;
                        $monthlyBalance->status = 'P';
                        $monthlyBalance->save();

                        Audit::setActivity('Malipo ya kiasi ('.$model->amount.' kimehakikiwa na kupokelewa na kashia '.CashierAccount::geAccountByUserId($model->related_customer).')','Malipo','Payment','','');
                        return array('success' => true, 'data' => 'successfully confirmed');

                    } else {
                        return array('success' => false, 'data' => 'Failed');
                    }
                }else{
                    return array('success' => false, 'data' => 'Gl account has less amount than the assigned amount');
                }
            }
        }

    }

    public function actionRegisterDeath($mzee_id,$user_id,$death_date,$reported_by)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $mzee = Mzee::find()->where(['id' => $mzee_id])->one();
        if($mzee != null){
            Mzee::updateAll(['status' => Mzee::SUSPENDED,'anaishi'=>Mzee::DIED,'aliyeleta_taarifa_kifo'=>$reported_by,'tarehe_kufariki' => $death_date,'mchukua_taarifa_kufariki' => User::getUsernameByUserId($user_id)],['id' => $mzee_id]);
            return array('success' => true, 'data' => 'Successfully updated');
        }else{
            return array('success' => false, 'data' => 'Failed to register death');
        }

    }

    public function actionLogin()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $model = new LoginForm();
        $params = Yii::$app->request->post();

        $model->username = $params['username'];
        $model->password = $params['password'];

        $user = User::findByUsername($model->username);
        // $user_type = UserSearch::find()->where(['username' => $user])->one();

        if (!empty($user)) {
            if ($model->login()) {
                $response['error'] = false;
                $response['status'] = 'success';
                $response['message'] = 'You are now logged in';
                $response['user'] = \common\models\User::findByUsername($model->username);
                $response = [

                    'success'=>true,
                    'access_token' => Yii::$app->user->identity->getAuthKey(),
                    'username' => Yii::$app->user->identity->username,
                    'user_id' => Yii::$app->user->identity->user_id,
                    'status' => Yii::$app->user->identity->status,
                    'kituo' => KituoCashier::getByCashierID(Yii::$app->user->identity->user_id),
                    //'wazee' => Mzee::getByCashierID(Yii::$app->user->identity->user_id),
                    'pendings' => Teller::getPending(Yii::$app->user->identity->user_id),
                    'current_balance' => AccdailyBal::getCurrentBalance(CashierAccount::geAccountByUserId(Yii::$app->user->identity->user_id))
                ];
                return $response;

            } else {
                $response['error'] = false;
                $response['status'] = 'error';
                $model->validate($model->password);
                $response['errors'] = $model->getErrors();
                $response['message'] = 'wrong password';
                return $response;
            }


        } else {
            $response['error'] = false;
            $response['status'] = 'error';
            $model->validate($model->password);
            $response['errors'] = $model->getErrors();
            $response['message'] = 'user is disabled or does not exist!';
            return $response;
        }

    }

}
