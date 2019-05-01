<?php

namespace backend\controllers;
ini_set('memory_limit', '256M');

use backend\models\AccdailyBal;
use backend\models\Audit;
use backend\models\CashierAccount;
use backend\models\EventType;
use backend\models\KituoMonthlyBalances;
use backend\models\KituoShehia;
use backend\models\Mzee;
use backend\models\Teller;
use backend\models\TodayEntry;
use backend\models\User;
use backend\models\Wafanyakazi;

use common\models\LoginForm;
use kartik\grid\EditableColumnAction;
use Yii;
use backend\models\Malipo;
use backend\models\MalipoSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MalipoController implements the CRUD actions for Malipo model.
 */
class MalipoController extends Controller
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
     * Lists all Malipo models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new MalipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMyPending()
    {

        $lastTransaction = \backend\models\Teller::getTransaction(Yii::$app->user->identity->user_id);

        if($lastTransaction != null) {
            $searchModel = new MalipoSearch();
            $dataProvider = $searchModel->searchMyPending($lastTransaction);

            return $this->render('mypending', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 1500,
                'icon' => 'fa fa-warning',
                'message' => 'haujapewa fedha za kuwalipa wazee msimu huu',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['site/index']);
        }
    }

    public function actionBulkPay()
    {

        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('payBeneficiary')) {
                $action = Yii::$app->request->post('action');
                $selection = (array)Yii::$app->request->post('selection');//typecasting
                if ($selection) {
                    foreach ($selection as $id) {
                        $malipo = Malipo::findOne((int)$id);//make a typecasting
                       // print_r($malipo->id.' - '. $id);
                      //  exit;

                        if ($malipo->status == Malipo::PAID) {
                            //return array('success' => false, 'error_code' => 300, 'error' => 'Already paid');
                            //paid
                        } else {
                            $malipo->status = Malipo::PAID;
                            $malipo->cashier_id = Yii::$app->user->identity->user_id;
                            $malipo->tarehe_kulipwa = date('Y-m-d');
                            $malipo->remarks = "Amelipwa kwa njia ya kawaida bila king'amuzi";
                            $malipo->payee_type = 5;
                            $malipo->verification_type = 5;
                            $malipo->aliyelipwa = 'NA';


                            $cashierBalance = AccdailyBal::getCurrentBalance(CashierAccount::geAccountByUserId(Yii::$app->user->identity->user_id));
                            if ($cashierBalance >= $malipo->kiasi) {

                                if ($malipo->save(false)) {


                                    //saves customer leg
                                    TodayEntry::saveEntry(
                                        $module = 'DE',
                                        'CSHD' . $malipo->mzee_id . date('ymd') . $malipo->id,
                                        date('Y-m-d'),
                                        CashierAccount::geAccountByUserId(Yii::$app->user->identity->user_id),
                                        Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                                        $malipo->kiasi,
                                        $ind = 'D',
                                        $malipo->mzee->majina_mwanzo . ' ' . $malipo->mzee->jina_babu . ' - ' . $malipo->mzee_id,
                                        'BCSH',
                                        date('Y-m-d'),
                                        EventType::INIT,
                                        User::getUsernameByUserId(Yii::$app->user->identity->user_id)
                                    );

                                    AccdailyBal::updateAccountBalance(CashierAccount::geAccountByUserId(Yii::$app->user->identity->user_id), $malipo->kiasi, 'D');

                                    //saves customer leg
                                    TodayEntry::saveEntry(
                                        $module = 'DE',
                                        'CSHD' . $malipo->mzee_id . date('ymd') . $malipo->id,
                                        date('Y-m-d'),
                                        $malipo->mzee->majina_mwanzo . ' ' . $malipo->mzee->jina_babu . ' - ' . $malipo->mzee_id,
                                        Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                                        $malipo->kiasi,
                                        $ind = 'C',
                                        $malipo->mzee->majina_mwanzo . ' ' . $malipo->mzee->jina_babu . ' - ' . $malipo->mzee_id,
                                        'BCSH',
                                        date('Y-m-d'),
                                        EventType::INIT,
                                        User::getUsernameByUserId(Yii::$app->user->identity->user_id)
                                    );


                                    TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => User::getUsernameByUserId(Yii::$app->user->identity->user_id), 'checker_time' => date('Y-m-d H:i:s')], ['trn_ref_no' => 'CSHD' . $malipo->mzee_id . date('ymd') . $malipo->id, 'auth_stat' => 'U']);


                                    KituoMonthlyBalances::updateMonthlyBalance($malipo->kituo_id, $malipo->voucher->mwezi, $malipo->voucher->mwaka, $malipo->kiasi, Yii::$app->user->identity->user_id);


                                } else {
                                   // return $this->redirect(['my-pending']);
                                }
                            } else {

                                Yii::$app->session->setFlash('', [
                                    'type' => 'warning',
                                    'duration' => 1500,
                                    'icon' => 'fa fa-warning',
                                    'message' => 'hauna fedha ya kutosha katika akaunti yako',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);

                                return $this->redirect(['my-pending']);
                            }

                        }

                       //
                    }
                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'message' => 'umefanikiwa kulipa',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['my-pending']);
                }
                else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 1500,
                        'icon' => 'fa fa-warning',
                        'message' => 'haujachagua malipo yoyote',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['my-pending']);
                    }



            }else {
                    //you are not allowed
                }

        }else{
                $model = new LoginForm();
                return $this->redirect(['site/login',
                    'model' => $model,
                ]);
            }

    }

    public function actionSearchAll()
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('Cashier')) {
                $searchModel = new MalipoSearch();
                $dataProvider = $searchModel->searchMzeeByDistrictWorker(Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id));
                Audit::setActivity('Ameangalia orodha ya malipo','Malipo','Index','','');
                return $this->render('all', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }else{
                $searchModel = new MalipoSearch();
                $dataProvider = $searchModel->searchAll(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya malipo','Malipo','Index','','');
                return $this->render('all', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
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

    public function actionLeo()
    {

        $searchModel = new MalipoSearch();
        $dataProvider = $searchModel->searchLeo(Yii::$app->request->queryParams);

        return $this->render('waliolipwa_leo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExpired()
    {

        $searchModel = new MalipoSearch();
        $dataProvider = $searchModel->searchExpired(Yii::$app->request->queryParams);

        return $this->render('expired', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMalipoVituoni()
    {

        /*$wilaya = Wilaya::find()->all();
        return $this->render('malipo_kwa_vituo', [
            'wilaya' => $wilaya,
        ]);*/


        $searchModel = new MalipoSearch();
        $dataProvider = $searchModel->searchSummary(Yii::$app->request->queryParams);

        return $this->render('malipo_summary', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Malipo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Malipo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Malipo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Malipo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Malipo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionGetBalance($id)
    {
        $wazee = Mzee::find()->select('id')->where(['kituo_id' => $id]);
        $malipo = Malipo::find()->where(['in','mzee_id',$wazee])->andWhere(['status' => Malipo::PENDING])->sum('kiasi');
        if($malipo != null){
            //check allocated balance
            $allocations = Teller::find()->where(['month' => date('m'), 'year' => date('Y'),'pay_point_id' => $id])->all();
        if($allocations != null) {
            $allocatedBalance = Teller::find()->where(['month' => date('m'), 'year' => date('Y'), 'pay_point_id' => $id])->sum('amount');

            if ($allocatedBalance < $malipo) {
                $newbalance = $malipo - $allocatedBalance;
                return $newbalance;
            } elseif ($allocatedBalance == $malipo) {
                return 0.00;
            } else {
                return false;
            }
        }else{
            return $malipo;
        }
        }else{
            return 0.00;
        }
    }

    /**
     * Finds the Malipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Malipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Malipo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'edittarehe' => [                                       // identifier for your editable action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => Malipo::className(),             // the update model class
                'outputValue' => function ($model, $attribute, $key, $index) {
                    $fmt = Yii::$app->formatter;
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'siku_mwisho') // selective validation by attribute
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
