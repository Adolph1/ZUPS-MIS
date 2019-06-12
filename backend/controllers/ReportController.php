<?php

namespace backend\controllers;

use backend\models\AccdailyBal;
use backend\models\Audit;
use backend\models\BudgetSearch;
use backend\models\CashierAccount;
use backend\models\EventType;
use backend\models\GlDailyBalance;
use backend\models\HamishaMzee;
use backend\models\HamishaMzeeSearch;
use backend\models\KituoMonthlyBalances;
use backend\models\KituoMonthlyBalancesSearch;
use backend\models\KituoShehia;
use backend\models\KituoShehiaSearch;
use backend\models\MalipoMaafisa;
use backend\models\MalipoMaafisaSearch;
use backend\models\MalipoSearch;
use backend\models\MalipoWatendajiSearch;
use backend\models\MatumiziMengine;
use backend\models\MatumiziMengineSearch;
use backend\models\MzeeSearch;
use backend\models\ProductAccrole;
use backend\models\Shehia;
use backend\models\ShehiaSearch;
use backend\models\TodayEntry;
use backend\models\WazeeWaliotenguliwaoSearch;
use common\models\LoginForm;
use Yii;
use backend\models\Report;
use backend\models\ReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReportController implements the CRUD actions for Report model.
 */
class ReportController extends Controller
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
                    'delete' => ['POST'],'balance'=>['POST']
                ],
            ],
        ];
    }

    /**
     * Lists all Report models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    public function actionKiwilaya()
    {
        if (!Yii::$app->user->isGuest) {

        return $this->render('kiwilaya');
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionWazeeKiwilaya()
    {
        if (!Yii::$app->user->isGuest) {
        return $this->render('wazee_kiwilaya');
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }



    public function actionWazeeMwaka()
    {
        if (!Yii::$app->user->isGuest) {
        $model = new Report();

        return $this->render('wazee_kwa_mwaka', [
            'model'=>$model,

            ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    //report by regions
    public function actionKimkoa()
    {
        if (!Yii::$app->user->isGuest) {
        return $this->render('kimkoa');
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    //report by new registered and dead in one month
    public function actionNewDead()
    {
        if (!Yii::$app->user->isGuest) {
        return $this->render('new_dead');
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    //report by new died beneficiaries per district
    public function actionDeadKiwilaya()
    {
        if (!Yii::$app->user->isGuest) {

            return $this->render('died');
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }



    //report to show all watendaji payments
    public function actionWatendaji()
    {
        if (!Yii::$app->user->isGuest) {

            $searchModel = new MalipoWatendajiSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('watendaji', [
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


    //report to show all maofisa payments
    public function actionMaofisa()
    {
        if (!Yii::$app->user->isGuest) {

            $searchModel = new MalipoMaafisaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('maofisa', [
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



    //report to show all bidhaa payments
    public function actionBidhaa()
    {
        if (!Yii::$app->user->isGuest) {

            $searchModel = new MatumiziMengineSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('malipo_bidhaa', [
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


    //report to show all budgets
    public function actionBudget()
    {
        if (!Yii::$app->user->isGuest) {

            $searchModel = new BudgetSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('budget', [
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


    //report to show all budgets
    public function actionBudgetBakaa()
    {
        if (!Yii::$app->user->isGuest) {

            $searchModel = new BudgetSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('budget_bakaa', [
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



    public function actionRestore()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new WazeeWaliotenguliwaoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            Audit::setActivity('Ameangalia wazee waliotenguliwa ','Wazee','Restore','','');
            return $this->render('waliotenguliwa', [
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



    public function actionWithFingerDistrict()
    {
        if (!Yii::$app->user->isGuest) {

          $searchModel = new ShehiaSearch();
          $dataProvider = $searchModel->searchAll(Yii::$app->request->queryParams);
        return $this->render('with_finger_wilaya', [
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

    public function actionWithFingerKituo()
    {

        if (!Yii::$app->user->isGuest) {
        $searchModel = new KituoShehiaSearch();
        $dataProvider = $searchModel->searchAll(Yii::$app->request->queryParams);
        return $this->render('with_finger_kituo', [
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




    public function actionDailyBalance()
    {

        if (!Yii::$app->user->isGuest) {
        return $this->render('cashiers_daily_balances');
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionBalance($id)
    {
        $model = AccdailyBal::findOne($id);
        $role_events=ProductAccrole::getRoleEvents($productcode = 'CSHW',$event=EventType::INIT);
        $cashrefno = 'CSHW123466';
        if($role_events!=null) {
            foreach ($role_events as $role_event) {
                if ($role_event->dr_cr_indicator == 'D') {


                    //saves customer leg
                    TodayEntry::saveEntry(
                        $module = 'DE',
                        $cashrefno,
                        date('Y-m-d'),
                        $model->account,
                        $model->branch_code,
                        $model->available_balance,
                        $ind = 'D',
                        CashierAccount::getCustomerNumberByAccount($model->account),
                        $product = 'CSHW',
                        date('Y-m-d'),
                        $event,
                        Yii::$app->user->identity->username
                    );

                    //updates customer account balance

                    AccdailyBal::updateAccountBalance($model->account, $model->available_balance, 'D');


                } elseif ($role_event->dr_cr_indicator == 'C') {

                    //saves GL leg
                    TodayEntry::saveEntry(
                         $module = 'DE',
                        $cashrefno,
                        date('Y-m-d'),
                        $role_event->mis_head,
                        $model->branch_code,
                        $model->available_balance,
                        $ind = 'C',
                        CashierAccount::getCustomerNumberByAccount($model->account),
                        $product = 'CSHW',
                        date('Y-m-d'),
                        $event,
                        Yii::$app->user->identity->username
                    );


                    //updates GL balance

                    GlDailyBalance::updateGLBalance($role_event->mis_head, $model->available_balance, 'C');
                    // KituoBalance::updateKituoBalance($model->pay_point, $model->offset_amount, 'D');


                }
            }

        TodayEntry::updateAll(['auth_stat'=>'A','checker_id'=>Yii::$app->user->identity->username,'checker_time'=> date('Y-m-d H:i')],['trn_ref_no'=>'CSHW'.date('YmdHis'),'auth_stat'=>'U']) ;
            $model->status = 'A';
            $model->checker_id = Yii::$app->user->identity->username;
            $model->save();
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 6000,
                'icon' => 'fa fa-check',
                'message' => 'Umefanikiwa kufunga mahesabu',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->render('cashiers_daily_balances');

               // print_r($model->branch_code);

        }



    }


    public function actionDied()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new MzeeSearch();
            $dataProvider = $searchModel->searchDied(Yii::$app->request->queryParams);

            return $this->render('died', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
                $model = new LoginForm();
                return $this->redirect(['site/login',
                    'model' => $model,
                ]);
            }

    }



    public function actionTransferred()
    {
        if (!Yii::$app->user->isGuest) {
        $searchModel = new HamishaMzeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('waliohama', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionReceived()
    {
        if (!Yii::$app->user->isGuest) {
        $searchModel = new HamishaMzeeSearch();
        $dataProvider = $searchModel->searchReceived(Yii::$app->request->queryParams);

        return $this->render('waliohamia', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }



    /**
     * Displays a single Report model.
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
     * Creates a new Report model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Report model.
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
     * Deletes an existing Report model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Report model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Report the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Report::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
