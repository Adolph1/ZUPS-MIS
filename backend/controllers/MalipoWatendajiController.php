<?php

namespace backend\controllers;

use backend\models\AccdailyBal;
use backend\models\CashierAccount;
use backend\models\EventType;
use backend\models\GlDailyBalance;
use backend\models\MiamalaWatendaji;
use backend\models\ProductAccrole;
use backend\models\Reference;
use backend\models\TodayEntry;
use backend\models\Wafanyakazi;
use backend\models\Zone;
use Yii;
use backend\models\MalipoWatendaji;
use backend\models\MalipoWatendajiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MalipoWatendajiController implements the CRUD actions for MalipoWatendaji model.
 */
class MalipoWatendajiController extends Controller
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
     * Lists all MalipoWatendaji models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MalipoWatendajiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MalipoWatendaji model.
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
     * Creates a new MalipoWatendaji model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MalipoWatendaji();
        if(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::UNGUJA) {
            $model->product = 'FZWU';
        }elseif (Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::PEMBA){
            $model->product = 'FZWP';
        }
        $reference = Reference::findLastWatendajiPaid($model->product);
        $model->kumbukumbu_no = $reference;
        if ($model->load(Yii::$app->request->post()) ) {
            $cashierBalance = AccdailyBal::getCurrentBalance(CashierAccount::geAccountByUserId($model->muamala->cashier_id));
            if ($cashierBalance >= $_POST['MalipoWatendaji']['kiasi_alichopewa']) {
                $model->save();
                MiamalaWatendaji::updateBalance($model->muamala_id,$model->kiasi_alichopewa);

                //saves customer leg
                TodayEntry::saveEntry(
                    $module = 'MW',
                    $reference,
                    date('Y-m-d'),
                    $model->jina_kamili,
                    Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                    $model->kiasi_alichopewa,
                    $ind = 'C',
                    $model->jina_kamili,
                    $model->product,
                    date('Y-m-d'),
                    EventType::INIT,
                    Yii::$app->user->identity->username
                );


                //saves GL leg
                TodayEntry::saveEntry(
                    $module = 'MW',
                    $reference,
                    date('Y-m-d'),
                    CashierAccount::geAccountByUserId(MiamalaWatendaji::getCashierId($model->muamala_id)),
                    Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                    $model->kiasi_alichopewa,
                    $ind = 'D',
                    Wafanyakazi::getFullnameByUserId(MiamalaWatendaji::getCashierId($model->muamala_id)),
                    $model->product,
                    date('Y-m-d'),
                    EventType::INIT,
                    Yii::$app->user->identity->username
                );


                //updates Cashier Account balance

                AccdailyBal::updateAccountBalance( CashierAccount::geAccountByUserId($model->muamala->cashier_id),$model->kiasi_alichopewa,'D');




                TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' =>  Yii::$app->user->identity->user_id, 'checker_time' =>  date('Y-m-d H:i:s'),], ['trn_ref_no' => $reference, 'auth_stat' => 'U']);


                return $this->redirect(['miamala-watendaji/view', 'id' => $model->muamala_id]);
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => 'hauna fedha ya kutosha katika akaunti yako',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['miamala-watendaji/view', 'id' => $model->muamala->id]);

            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionLipaMtendaji()
    {
        $model = new MalipoWatendaji();
        if(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::UNGUJA) {
            $model->product = 'FZWU';
        }elseif (Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::PEMBA){
            $model->product = 'FZWP';
        }
        $reference = Reference::findLastWatendajiPaid($model->product);
        $model->kumbukumbu_no = $reference;
        $model->muamala_id = MiamalaWatendaji::getLastTransactionIDByUserId(Yii::$app->user->identity->user_id);
        if($model->muamala_id != null) {

            if ($model->load(Yii::$app->request->post())) {
                $cashierBalance = AccdailyBal::getCurrentBalance(CashierAccount::geAccountByUserId(Yii::$app->user->identity->user_id));
                if ($cashierBalance >= $_POST['MalipoWatendaji']['kiasi_alichopewa']) {
                    $model->save();
                    MiamalaWatendaji::updateBalance($model->muamala_id, $model->kiasi_alichopewa);


                    //saves customer leg
                    TodayEntry::saveEntry(
                        $module = 'MW',
                        $reference,
                        date('Y-m-d'),
                        $model->jina_kamili,
                        Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                        $model->kiasi_alichopewa,
                        $ind = 'C',
                        $model->jina_kamili,
                        $model->product,
                        date('Y-m-d'),
                        EventType::INIT,
                        Yii::$app->user->identity->username
                    );


                    //saves GL leg
                    TodayEntry::saveEntry(
                        $module = 'MW',
                        $reference,
                        date('Y-m-d'),
                        CashierAccount::geAccountByUserId(MiamalaWatendaji::getCashierId($model->muamala_id)),
                        Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                        $model->kiasi_alichopewa,
                        $ind = 'D',
                        Wafanyakazi::getFullnameByUserId(MiamalaWatendaji::getCashierId($model->muamala_id)),
                        $model->product,
                        date('Y-m-d'),
                        EventType::INIT,
                        Yii::$app->user->identity->username
                    );


                    //updates Cashier Account balance

                    AccdailyBal::updateAccountBalance(CashierAccount::geAccountByUserId($model->muamala->cashier_id), $model->kiasi_alichopewa, 'D');


                    TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => Yii::$app->user->identity->user_id, 'checker_time' => date('Y-m-d H:i:s'),], ['trn_ref_no' => $reference, 'auth_stat' => 'U']);

                    return $this->redirect(['miamala-watendaji/view', 'id' => $model->muamala_id]);
                }else{
                    Yii::$app->session->setFlash('', [
                        'type' => 'danger',
                        'duration' => 1500,
                        'icon' => 'fa fa-warning',
                        'message' => 'hauna pesa za kutosha katika akaunti yako',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->redirect(['site/index']);
                }
            }else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 1500,
                'icon' => 'fa fa-warning',
                'message' => 'haujapewa fedha za kuwalipa watendaji msimu huu',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Updates an existing MalipoWatendaji model.
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
     * Deletes an existing MalipoWatendaji model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = 'D';
        if($model->save())
        {
            MiamalaWatendaji::reverseMuamala($model->muamala_id,$model->kiasi_alichopewa);
        }
        return $this->redirect(['miamala-watendaji/view', 'id' => $model->muamala_id]);
    }

    /**
     * Finds the MalipoWatendaji model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MalipoWatendaji the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MalipoWatendaji::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
