<?php

namespace backend\controllers;

use backend\models\AccdailyBal;
use backend\models\Budget;
use backend\models\CashierAccount;
use backend\models\EventType;
use backend\models\GlDailyBalance;
use backend\models\MalipoWatendaji;
use backend\models\MzeeMsaidiziWengine;
use backend\models\ProductAccrole;
use backend\models\Reference;
use backend\models\TodayEntry;
use backend\models\Wafanyakazi;
use backend\models\Zone;
use Yii;
use backend\models\MiamalaWatendaji;
use backend\models\MiamalaWatendajiSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MiamalaWatendajiController implements the CRUD actions for MiamalaWatendaji model.
 */
class MiamalaWatendajiController extends Controller
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
     * Lists all MiamalaWatendaji models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MiamalaWatendajiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MiamalaWatendaji model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $malipo = new MalipoWatendaji();

        return $this->render('view', [
            'model' => $this->findModel($id), 'malipo' => $malipo,
        ]);
    }

    /**
     * Creates a new MiamalaWatendaji model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MiamalaWatendaji();
        $model->status = MiamalaWatendaji::PENDING;

        if(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::UNGUJA) {
            $product = 'UFZM';
        }elseif (Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::PEMBA){
            $product = 'PFZM';
        }
        $reference = Reference::findLastWatendajiProduct($product);
        $gl = ProductAccrole::getGlCodeCodeByProductCode($product);
        $glBalance = GlDailyBalance::getCurrentBalance($gl);

        if($glBalance != null) {
            $budget = Budget::getCurrent();
            if ($budget == null) {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 4500,
                    'icon' => 'fa fa-warning',
                    'message' => 'Tafadhari ingiza budget kwanza',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['index']);
            }else{
                $model->budget_id = $budget;
            }
            $zone = Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id);
            if ($zone == null) {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 4500,
                    'icon' => 'fa fa-warning',
                    'message' => 'Tafadhari ingiza zone kwanza',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['index']);
            }
            
            

        if ($model->load(Yii::$app->request->post())) {
            if ($glBalance >= $_POST['MiamalaWatendaji']['kiasi']) {
                $model->save();
            $role_events = ProductAccrole::getRoleEvents($product, $event = EventType::INIT);
            if ($role_events != null) {
                foreach ($role_events as $role_event) {
                    if ($role_event->dr_cr_indicator == 'C') {


                        //saves customer leg
                        TodayEntry::saveEntry(
                            $module = 'FW',
                            $reference,
                            date('Y-m-d'),
                            CashierAccount::geAccountByUserId($model->cashier_id),
                            $zone,
                            $model->kiasi,
                            $ind = 'C',
                            '',
                            $product,
                            date('Y-m-d'),
                            $event,
                            Yii::$app->user->identity->username
                        );
                        AccdailyBal::updateAccountBalance(CashierAccount::geAccountByUserId($model->cashier_id), $model->kiasi, 'C');


                    } elseif ($role_event->dr_cr_indicator == 'D') {

                        //saves GL leg
                        TodayEntry::saveEntry(
                            $module = 'FW',
                            $reference,
                            date('Y-m-d'),
                            $role_event->mis_head,
                            $zone,
                            $model->kiasi,
                            $ind = 'D',
                            '',
                            $product,
                            date('Y-m-d'),
                            $event,
                            Yii::$app->user->identity->username
                        );


                        //updates GL balance

                        GlDailyBalance::updateGLBalance($role_event->mis_head, $model->kiasi, 'D');


                    }
                }
            }
            TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => Yii::$app->user->identity->username, 'checker_time' => date('Y-m-d H:i:s')], ['trn_ref_no' => $reference, 'auth_stat' => 'U']);


            return $this->redirect(['view', 'id' => $model->id]);
        }else{
                //account has less amount
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 4500,
                    'icon' => 'fa fa-warning',
                    'message' => 'hauna kiasi cha kutosha katika budget ya uendashaji',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        }else{
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 4500,
                'icon' => 'fa fa-warning',
                'message' => 'Tafadhari hakikisha umeweka fedha katika akaunti ya uendeshaji',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing MiamalaWatendaji model.
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
     * Deletes an existing MiamalaWatendaji model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }catch (Exception $exception) {
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 4500,
                'icon' => 'fa fa-warning',
                'message' => 'Huwezi kufuta muamala huu kwa kuwa kuna malipo yamefanyika',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the MiamalaWatendaji model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MiamalaWatendaji the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MiamalaWatendaji::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
