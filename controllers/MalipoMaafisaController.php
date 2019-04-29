<?php

namespace backend\controllers;

use backend\models\AccdailyBal;
use backend\models\Audit;
use backend\models\Budget;
use backend\models\EventType;
use backend\models\GeneralLedger;
use backend\models\GlDailyBalance;
use backend\models\Product;
use backend\models\ProductAccrole;
use backend\models\Reference;
use backend\models\TodayEntry;
use backend\models\Vituo;
use backend\models\Wafanyakazi;
use backend\models\Zone;
use common\models\LoginForm;
use Yii;
use backend\models\MalipoMaafisa;
use backend\models\MalipoMaafisaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MalipoMaafisaController implements the CRUD actions for MalipoMaafisa model.
 */
class MalipoMaafisaController extends Controller
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
     * Lists all MalipoMaafisa models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new MalipoMaafisaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            Audit::setActivity('ameangalia orodha ya malipo ya maafisa', 'MalipoMaafisa', 'Index', '', '');
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

    /**
     * Displays a single MalipoMaafisa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
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
     * Creates a new MalipoMaafisa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (!Yii::$app->user->isGuest) {
        $model = new MalipoMaafisa();
        $model->tarehe_ya_malipo = date('Y-m-d');
        $model->aliyeingiza = Yii::$app->user->identity->username;
        $model->muda = date('Y-m-d H:i:s');

        if(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::UNGUJA) {
            $model->product = 'UFZM';
        }elseif (Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::PEMBA){
            $model->product = 'PFZM';
        }
        $model->kumbukumbu_no = Reference::findLastWatendajiProduct($model->product);
        $gl = ProductAccrole::getGlCodeCodeByProductCode($model->product);
       $glBalance = GlDailyBalance::getCurrentBalance($gl);
       if($glBalance != null) {
           $model->budget_id = Budget::getCurrent();
           if ($model->budget_id == null) {
               Yii::$app->session->setFlash('', [
                   'type' => 'warning',
                   'duration' => 4500,
                   'icon' => 'fa fa-warning',
                   'message' => 'Tafadhari ingiza budget kwanza',
                   'positonY' => 'top',
                   'positonX' => 'right'
               ]);
               return $this->redirect(['index']);
           }
           $model->zone_id = Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id);
           if ($model->zone_id == null) {
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

               if($_POST['MalipoMaafisa']['kiasi'] <= $glBalance) {
                   $model->wilaya_id = Vituo::getWilayaIDByKituoID($_POST['MalipoMaafisa']['kituo_id']);

                   $model->save();
                   $role_events = ProductAccrole::getRoleEvents($model->product, $event = EventType::INIT);
                   if ($role_events != null) {
                       foreach ($role_events as $role_event) {
                           if ($role_event->dr_cr_indicator == 'C') {


                               //saves customer leg
                               TodayEntry::saveEntry(
                                   $module = 'FW',
                                   $model->kumbukumbu_no,
                                   date('Y-m-d'),
                                   $model->jina_kamili,
                                   $model->zone_id,
                                   $model->kiasi,
                                   $ind = 'C',
                                   $model->jina_kamili,
                                   $model->product,
                                   date('Y-m-d'),
                                   $event,
                                   $model->aliyeingiza
                               );


                           } elseif ($role_event->dr_cr_indicator == 'D') {

                               //saves GL leg
                               TodayEntry::saveEntry(
                                   $module = 'FW',
                                   $model->kumbukumbu_no,
                                   date('Y-m-d'),
                                   $role_event->mis_head,
                                   $model->zone_id,
                                   $model->kiasi,
                                   $ind = 'D',
                                   $model->jina_kamili,
                                   $model->product,
                                   date('Y-m-d'),
                                   $event,
                                   $model->aliyeingiza
                               );


                               //updates GL balance

                               GlDailyBalance::updateGLBalance($role_event->mis_head, $model->kiasi, 'D');


                           }
                       }
                   }
                   TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->aliyeingiza, 'checker_time' => $model->muda], ['trn_ref_no' => $model->kumbukumbu_no, 'auth_stat' => 'U']);


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
            $model->status = 'R';


            $role_events=ProductAccrole::getRoleEvents($model->product,$event=EventType::RVS);
            if($role_events!=null) {
                foreach ($role_events as $role_event) {
                    if ($role_event->dr_cr_indicator == 'D') {


                        //saves customer leg
                        TodayEntry::saveEntry(
                            $module = 'FW',
                            $model->kumbukumbu_no,
                            date('Y-m-d'),
                            $model->jina_kamili,
                            $model->zone_id,
                            $model->kiasi,
                            $ind = 'D',
                            '',
                            $model->product,
                            date('Y-m-d'),
                            $event,
                            $model->aliyeingiza
                        );



                    } elseif ($role_event->dr_cr_indicator == 'C') {

                        //saves GL leg
                        TodayEntry::saveEntry(
                            $module = 'FW',
                            $model->kumbukumbu_no,
                            date('Y-m-d'),
                            $role_event->mis_head,
                            $model->zone_id,
                            $model->kiasi,
                            $ind = 'C',
                            '',
                            $model->product,
                            date('Y-m-d'),
                            $event,
                            $model->aliyeingiza
                        );


                        //updates GL balance

                        GlDailyBalance::updateGLBalance($role_event->mis_head, $model->kiasi, 'C');



                    }
                }
            }

            TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->aliyeingiza, 'checker_time' => $model->muda], ['trn_ref_no' => $model->kumbukumbu_no, 'auth_stat' => 'U']);

            $model->save();

            return $this->redirect(['view','id'=>$id]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MalipoMaafisa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        if (!Yii::$app->user->isGuest) {
        $model = $this->findModel($id);

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
     * Deletes an existing MalipoMaafisa model.
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
     * Finds the MalipoMaafisa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MalipoMaafisa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MalipoMaafisa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
