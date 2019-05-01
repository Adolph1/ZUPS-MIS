<?php

namespace backend\controllers;

use backend\models\Budget;
use backend\models\EventType;
use backend\models\GeneralLedger;
use backend\models\GlDailyBalance;
use backend\models\Reference;
use backend\models\TodayEntry;
use backend\models\Wafanyakazi;
use backend\models\Zone;
use common\models\LoginForm;
use Yii;
use backend\models\FundBudget;
use backend\models\FundBudgetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FundBudgetController implements the CRUD actions for FundBudget model.
 */
class FundBudgetController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all FundBudget models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FundBudgetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FundBudget model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FundBudget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         if (!Yii::$app->user->isGuest) {
                $model = new FundBudget();
                $model->aliyeingiza = Yii::$app->user->identity->username;
                $model->muda = date('Y-m-d H:i');
                $model->kumbukumbu_no = Reference::findLastFund();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    $model->bakaa = $model->jumla-$model->kiasi_kilichotolewa;
                    FundBudget::updateAll(['bakaa' => $model->bakaa],['id' => $model->id]);
                    Budget::updateAll(['status' => Budget::FUNDED],['id' => $model->budget_id]);
                    $budgetZone = Budget::getZoneById($model->budget_id);
                    if($budgetZone == Zone::PEMBA) {
                        GlDailyBalance::updateGLBalance(GeneralLedger::PEMBAPENCHENI, $model->kiasi_kilichotolewa,  'C');


                        TodayEntry::saveEntry(
                            $module = 'FB',
                            $model->kumbukumbu_no,
                            date('Y-m-d'),
                            GeneralLedger::PEMBAPENCHENI,
                            Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                            $model->kiasi_kilichotolewa,
                            $ind = 'C',
                            GeneralLedger::getDescByGLCODE(GeneralLedger::PEMBAPENCHENI),
                            'FBGT',
                            date('Y-m-d'),
                            EventType::INIT,
                            $model->aliyeingiza
                        );
                        if(TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->aliyeingiza, 'checker_time' => $model->muda], ['trn_ref_no' => $model->kumbukumbu_no, 'auth_stat' => 'U'])){
                            GlDailyBalance::updateGLBalance(GeneralLedger::PEMBAPENCHENI, $model->wazee,  'D');


                            TodayEntry::saveEntry(
                                $module = 'FB',
                                'WZ'.$model->kumbukumbu_no,
                                date('Y-m-d'),
                                GeneralLedger::PEMBAPENCHENI,
                                Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                                $model->wazee,
                                $ind = 'D',
                                GeneralLedger::getDescByGLCODE(GeneralLedger::PEMBAPENCHENI),
                                'FBGT',
                                date('Y-m-d'),
                                EventType::INIT,
                                $model->aliyeingiza
                            );
                            GlDailyBalance::updateGLBalance(GeneralLedger::PEMBAWAZEE, $model->wazee, 'C');
                            TodayEntry::saveEntry(
                                $module = 'FB',
                                'WZ'.$model->kumbukumbu_no,
                                date('Y-m-d'),
                                GeneralLedger::PEMBAWAZEE,
                                Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                                $model->wazee,
                                $ind = 'C',
                                GeneralLedger::getDescByGLCODE(GeneralLedger::PEMBAWAZEE),
                                'FBGT',
                                date('Y-m-d'),
                                EventType::INIT,
                                $model->aliyeingiza
                            );
                            TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->aliyeingiza, 'checker_time' => $model->muda], ['trn_ref_no' => 'WZ'.$model->kumbukumbu_no, 'auth_stat' => 'U']);


                            GlDailyBalance::updateGLBalance(GeneralLedger::PEMBAPENCHENI, $model->uendeshaji, 'D');


                            TodayEntry::saveEntry(
                                $module = 'FB',
                                'UD'.$model->kumbukumbu_no,
                                date('Y-m-d'),
                                GeneralLedger::PEMBAPENCHENI,
                                Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                                $model->uendeshaji,
                                $ind = 'D',
                                GeneralLedger::getDescByGLCODE(GeneralLedger::PEMBAPENCHENI),
                                'FBGT',
                                date('Y-m-d'),
                                EventType::INIT,
                                $model->aliyeingiza
                            );
                            GlDailyBalance::updateGLBalance(GeneralLedger::PEMBAUENDESHAJI, $model->uendeshaji, 'C');
                            TodayEntry::saveEntry(
                                $module = 'FB',
                                'UD'.$model->kumbukumbu_no,
                                date('Y-m-d'),
                                GeneralLedger::PEMBAUENDESHAJI,
                                Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                                $model->uendeshaji,
                                $ind = 'C',
                                GeneralLedger::getDescByGLCODE(GeneralLedger::PEMBAPENCHENI),
                                'FBGT',
                                date('Y-m-d'),
                                EventType::INIT,
                                $model->aliyeingiza
                            );
                            TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->aliyeingiza, 'checker_time' => $model->muda], ['trn_ref_no' => 'UD'.$model->kumbukumbu_no, 'auth_stat' => 'U']);


                        }
                    }elseif ($budgetZone == Zone::UNGUJA){
                        GlDailyBalance::updateGLBalance(GeneralLedger::UNGUJAPENCHENI, $model->kiasi_kilichotolewa, 'C');


                        TodayEntry::saveEntry(
                            $module = 'FB',
                            $model->kumbukumbu_no,
                            date('Y-m-d'),
                            GeneralLedger::UNGUJAPENCHENI,
                            Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                            $model->jumla,
                            $ind = 'C',
                            GeneralLedger::getDescByGLCODE(GeneralLedger::UNGUJAPENCHENI),
                            'FBGT',
                            date('Y-m-d'),
                            EventType::INIT,
                            $model->aliyeingiza
                        );
                        if(TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->aliyeingiza, 'checker_time' => $model->muda], ['trn_ref_no' => $model->kumbukumbu_no, 'auth_stat' => 'U'])){
                            GlDailyBalance::updateGLBalance(GeneralLedger::UNGUJAPENCHENI, $model->wazee,  'D');


                            TodayEntry::saveEntry(
                                $module = 'FB',
                                'WZ'.$model->kumbukumbu_no,
                                date('Y-m-d'),
                                GeneralLedger::UNGUJAPENCHENI,
                                Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                                $model->wazee,
                                $ind = 'D',
                                GeneralLedger::getDescByGLCODE(GeneralLedger::UNGUJAPENCHENI),
                                'FBGT',
                                date('Y-m-d'),
                                EventType::INIT,
                                $model->aliyeingiza
                            );
                            GlDailyBalance::updateGLBalance(GeneralLedger::UNGUJAWAZEE, $model->wazee,  'C');
                            TodayEntry::saveEntry(
                                $module = 'FB',
                                'WZ'.$model->kumbukumbu_no,
                                date('Y-m-d'),
                                GeneralLedger::UNGUJAWAZEE,
                                Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                                $model->wazee,
                                $ind = 'C',
                                GeneralLedger::getDescByGLCODE(GeneralLedger::UNGUJAWAZEE),
                                'FBGT',
                                date('Y-m-d'),
                                EventType::INIT,
                                $model->aliyeingiza
                            );
                            TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->aliyeingiza, 'checker_time' => $model->muda], ['trn_ref_no' => 'WZ'.$model->kumbukumbu_no, 'auth_stat' => 'U']);


                            GlDailyBalance::updateGLBalance(GeneralLedger::UNGUJAPENCHENI, $model->uendeshaji, 'D');


                            TodayEntry::saveEntry(
                                $module = 'FB',
                                'UD'.$model->kumbukumbu_no,
                                date('Y-m-d'),
                                GeneralLedger::UNGUJAPENCHENI,
                                Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                                $model->uendeshaji,
                                $ind = 'D',
                                GeneralLedger::getDescByGLCODE(GeneralLedger::UNGUJAPENCHENI),
                                'FBGT',
                                date('Y-m-d'),
                                EventType::INIT,
                                $model->aliyeingiza
                            );
                            GlDailyBalance::updateGLBalance(GeneralLedger::UNGUJAUENDESHAJI, $model->uendeshaji, 'C');
                            TodayEntry::saveEntry(
                                $module = 'FB',
                                'UD'.$model->kumbukumbu_no,
                                date('Y-m-d'),
                                GeneralLedger::UNGUJAUENDESHAJI,
                                Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                                $model->uendeshaji,
                                $ind = 'C',
                                GeneralLedger::getDescByGLCODE(GeneralLedger::UNGUJAUENDESHAJI),
                                'FBGT',
                                date('Y-m-d'),
                                EventType::INIT,
                                $model->aliyeingiza
                            );
                            TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->aliyeingiza, 'checker_time' => $model->muda], ['trn_ref_no' => 'UD'.$model->kumbukumbu_no, 'auth_stat' => 'U']);


                        }
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('create', [
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
     * Updates an existing FundBudget model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FundBudget model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FundBudget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FundBudget the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FundBudget::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
