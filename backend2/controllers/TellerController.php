<?php

namespace backend\controllers;

use backend\models\AccdailyBal;
use backend\models\Account;
use backend\models\Branch;
use backend\models\CashierAccount;
use backend\models\Customer;
use backend\models\CustomerBalance;
use backend\models\EventType;
use backend\models\GlDailyBalance;
use backend\models\MahesabuBreakdown;
use backend\models\MahesabuYaliofungwa;
use backend\models\Mkoa;
use backend\models\ProductAccrole;
use backend\models\Reference;
use backend\models\SystemDate;
use backend\models\TodayEntry;
use backend\models\Vituo;
use backend\models\Wafanyakazi;
use backend\models\Wilaya;
use backend\models\Zone;
use kartik\grid\EditableColumnAction;
use Yii;
use backend\models\Teller;
use backend\models\TellerSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ReferenceIndex;
use common\models\LoginForm;
/**
 * TellerController implements the CRUD actions for Teller model.
 */
class TellerController extends Controller
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

    /**
     * Lists all Teller models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest) {
            $searchModel = new TellerSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else{
                $model = new LoginForm();
                return $this->redirect(['site/login',
                    'model' => $model,
                ]);
            }
    }


    public function actionSchedule()
    {
        if(!Yii::$app->user->isGuest) {
            $searchModel = new TellerSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('schedule', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    /**
     * Displays a single Teller model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!Yii::$app->user->isGuest) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Teller model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->isGuest) {
            if(yii::$app->User->can('Accountant')) {

                //checks if there are pending closed transactions
                $mkoa=Mkoa::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
                $wilaya = Wilaya::find()->select('id')->where(['in','mkoa_id',$mkoa]);
                $vituo = Vituo::find()->select('id')->where(['in','wilaya_id',$wilaya]);
                $mahesabu = MahesabuYaliofungwa::find()->where(['status' => MahesabuYaliofungwa::PENDING])->andWhere(['!=','tarehe_ya_kupewa',date('Y-m-d')])->andWhere(['in','kituo_id',$vituo])->all();
                if($mahesabu != null){

                    foreach ($mahesabu as $hesabu){

                        $dailbalance = AccdailyBal::find()->where(['account' => CashierAccount::geAccountByUserId($hesabu->cashier_id)])->orderBy(['id'=>SORT_DESC])->one();
                        $kilichobaki = $hesabu->kiasi_alichopewa- \backend\models\Malipo::getSumPerCashierID(\backend\models\CashierAccount::getCustomerNumberByAccount(\backend\models\CashierAccount::geAccountByUserId($hesabu->cashier_id)),$hesabu->tarehe_ya_kupewa);
                        if($kilichobaki == 0.00) {
                            $hesabu->status = 'C';
                        }else{
                            $hesabu->status = 'C';
                            $breakdown = new MahesabuBreakdown();
                            $breakdown->kiasi_kilichobaki = $kilichobaki;
                            $breakdown->mahesabu_id = $hesabu->id;
                            $breakdown->tarehe = date('Y-m-d');
                            $breakdown->save();
                        }
                        $hesabu->save();

                        AccdailyBal::updateAccountBalance($dailbalance->account, $hesabu->kiasi_alichorudisha, 'D');
                    }



                }
                    $model = new Teller();
                    $model->status = 'U';
                    $model->trn_dt = date('Y-m-d');
                    $model->maker_id = Yii::$app->user->identity->username;
                    $model->maker_time = date('Y-m-d H:i');
                    $model->month = date('m');
                    $model->year = date('Y');
                    $model->trn_type = Teller::PENSION;
                    if(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::UNGUJA) {
                        $model->product = 'UFZW';
                    }elseif (Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::PEMBA){
                        $model->product = 'PFZW';
                    }
                    $model->reference = Reference::getZoneTellerProduct($model->product);


                    if ($model->load(Yii::$app->request->post())) {

                        $customer_no = CashierAccount::getCustomerNumberByAccount($_POST['Teller']['txn_account']);
                        $model->offset_account = ProductAccrole::getGlCodeCodeByProductCode($model->product);
                        if ($customer_no != null) {
                            $model->related_customer = $customer_no;
                            // saves today's transactions
                            $checkPending = Teller::find()->where(['month' => $model->month, 'trn_dt' => date('Y-m-d'), 'year' => $model->year, 'pay_point_id' => $_POST['Teller']['pay_point_id']])->andWhere(['!=','status','R'])->all();
                            if (count($checkPending) > 0) {
                                Yii::$app->session->setFlash('', [
                                    'type' => 'warning',
                                    'duration' => 1500,
                                    'icon' => 'fa fa-warning',
                                    'message' => 'Muamala kama huu katika kituo hiki umekwisha fanyika,angalia orodha ya miamala',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);
                                return $this->render('create', [
                                    'model' => $model,
                                ]);
                            } else {
                                if ($_POST['Teller']['amount'] <= $_POST['Teller']['kituo_balance']) {
                                    if ($model->save()) {

                                        return $this->redirect(['view', 'id' => $model->id]);
                                    } else {
                                        Yii::$app->session->setFlash('', [
                                            'type' => 'warning',
                                            'duration' => 1500,
                                            'icon' => 'fa fa-warning',
                                            'message' => 'Transaction not saved',
                                            'positonY' => 'top',
                                            'positonX' => 'right'
                                        ]);
                                        return $this->render('create', [
                                            'model' => $model,
                                        ]);
                                    }
                                } else {
                                    Yii::$app->session->setFlash('', [
                                        'type' => 'warning',
                                        'duration' => 1500,
                                        'icon' => 'fa fa-warning',
                                        'message' => 'Transaction amount can not be greater than kituo balance',
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);

                                    return $this->render('create', [
                                        'model' => $model,
                                    ]);
                                }
                            }

                        } else {
                            Yii::$app->session->setFlash('', [
                                'type' => 'warning',
                                'duration' => 1500,
                                'icon' => 'fa fa-warning',
                                'message' => 'Wrong account details',
                                'positonY' => 'top',
                                'positonX' => 'right'
                            ]);

                            return $this->render('create', [
                                'model' => $model,
                            ]);
                        }
                    } else {
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }

            }
            else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => 'Hauna uwezo wa kuingiza muamala huu',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['index']);
            }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Teller model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->isGuest) {
        $model = $this->findModel($id);
        $model->maker_id=Yii::$app->user->identity->username;
        $model->status='U';
        $model->maker_time=date('Y-m-d:H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Teller model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->isGuest) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    /**
     * Penindings an existing Teller model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionPending()
    {
        if(!Yii::$app->user->isGuest) {
            $searchModel = new TellerSearch();
            $dataProvider = $searchModel->searchPending(Yii::$app->request->queryParams);

            return $this->render('pending', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);


        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    public function actionReverse($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);
            $model->status='R';

                $role_events=ProductAccrole::getRoleEvents($model->product,$event=EventType::RVS);
                if($role_events!=null) {
                    foreach ($role_events as $role_event) {
                        if ($role_event->dr_cr_indicator == 'D') {


                            //saves customer leg
                            TodayEntry::saveEntry(
                                $module = 'DE',
                                $model->reference,
                                date('Y-m-d'),
                                $model->txn_account,
                                Wafanyakazi::getZoneByID($model->related_customer),
                                $model->amount,
                                $ind = 'D',
                                Wafanyakazi::getFullnameByUserId($model->related_customer),
                                $model->product,
                                date('Y-m-d'),
                                $event,
                                $model->maker_id
                            );

                            //updates customer account balance

                            AccdailyBal::updateAccountBalance($model->txn_account, $model->amount, 'D');


                        } elseif ($role_event->dr_cr_indicator == 'C') {

                            TodayEntry::saveEntry(
                                $module = 'DE',
                                $model->reference,
                                date('Y-m-d'),
                                $role_event->mis_head,
                                Wafanyakazi::getZoneByID($model->related_customer),
                                $model->amount,
                                $ind = 'C',
                                Wafanyakazi::getFullnameByUserId($model->related_customer),
                                $model->product,
                                date('Y-m-d'),
                                $event,
                                $model->maker_id
                            );

                            //updates GL balance

                            GlDailyBalance::updateGLBalance($role_event->mis_head, $model->offset_amount, 'C');
                            MahesabuYaliofungwa::updateAll(['status' => 'D'], ['trn_id' => $model->id]);


                        }
                    }
                }
                TodayEntry::updateAll(['auth_stat'=>'A','checker_id'=>Yii::$app->user->identity->username,'checker_time'=>date('Y-m-d H:i:s')],['trn_ref_no'=>$model->reference,'auth_stat'=>'U']);


            $model->save();

            return $this->redirect(['teller/view','id'=>$id]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionApprove($id)
    {
        if(!Yii::$app->user->isGuest) {
        $model=$this->findModel($id);

        $model->checker_id=Yii::$app->user->identity->username;
        $model->checker_time = date('Y-m-d');
        $model->status='A';
        //$model->save();
        if($model->save()){
            $role_events=ProductAccrole::getRoleEvents($model->product,$event=EventType::INIT);
            if($role_events!=null) {
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
                            $model->related_customer,
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
                            Wafanyakazi::getZoneByID($model->related_customer),
                            $model->amount,
                            $ind = 'D',
                            $model->related_customer,
                            $model->product,
                            date('Y-m-d'),
                            $event,
                            $model->maker_id
                        );


                        //updates GL balance

                        GlDailyBalance::updateGLBalance($role_event->mis_head, $model->offset_amount, 'D');


                    }
                }
            }
            TodayEntry::updateAll(['auth_stat'=>'A','checker_id'=>$model->checker_id,'checker_time'=>$model->checker_time],['trn_ref_no'=>$model->reference,'auth_stat'=>'U']);
        }
        return $this->redirect(['view', 'id' => $model->id]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }






    /**
     * Finds the Teller model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teller the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teller::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }





    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'editkituo' => [                                       // identifier for your editable action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => Teller::className(),             // the update model class
                'outputValue' => function ($model, $attribute, $key, $index) {
                    $fmt = Yii::$app->formatter;
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'pay_point_id') // selective validation by attribute
                    {
                        return $value;       // return formatted value if desired


                    }
                    return '';                                   // empty is same as $value
                },
                'outputMessage' => function($model, $attribute, $key, $index) {
                    return '';                                  // any custom error after model save
                },
                // 'showModelErrors' => true,                     // show model errors after save
                // 'errorOptions' => ['header' => '']             // error summary HTML options
                // 'postOnly' => true,
                // 'ajaxOnly' => true,
                // 'findModel' => function($id, $action) {},
                // 'checkAccess' => function($action, $model) {}
            ]
        ]);

    }
}
