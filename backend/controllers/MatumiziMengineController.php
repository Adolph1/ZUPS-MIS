<?php

namespace backend\controllers;

use backend\models\Budget;
use backend\models\EventType;
use backend\models\GharamaMahitaji;
use backend\models\GlDailyBalance;
use backend\models\InventoryManagement;
use backend\models\Mahitaji;
use backend\models\MahitajiSearch;
use backend\models\ProductAccrole;
use backend\models\Reference;
use backend\models\TodayEntry;
use backend\models\Vituo;
use backend\models\Wafanyakazi;
use backend\models\Zone;
use common\models\LoginForm;
use Yii;
use backend\models\MatumiziMengine;
use backend\models\MatumiziMengineSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MatumiziMengineController implements the CRUD actions for MatumiziMengine model.
 */
class MatumiziMengineController extends Controller
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
     * Lists all MatumiziMengine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MatumiziMengineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all MatumiziMengine models.
     * @return mixed
     */
    public function actionOrdered()
    {
        $searchModel = new MatumiziMengineSearch();
        $dataProvider = $searchModel->searchOrdered(Yii::$app->request->queryParams);

        return $this->render('ordered', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MatumiziMengine model.
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
     * Creates a new MatumiziMengine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateBatch()
    {
        $searchModel = new MahitajiSearch();
        $dataProvider = $searchModel->searchWithoutPosho(Yii::$app->request->queryParams);
        $model = new MatumiziMengine();
        return $this->render('create_batch', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,'model' => $model
        ]);

    }


    public function actionBulkPay()
    {

        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('admin')) {
                $action = Yii::$app->request->post('action');
                $selection = (array)Yii::$app->request->post('selection');//typecasting
                $model = new MatumiziMengine();
                $model->tarehe = date('Y-m-d');
                $model->aliyeweka = Yii::$app->user->identity->username;
                $model->muda = date('Y-m-d H:i:s');
                $model->status = MatumiziMengine::PENDING;
                if ($selection) {
                    foreach ($selection as $id) {
                       // $mahitaji = GharamaMahitaji::findOne((int)$id);//make a typecasting
                        $model->idadi = GharamaMahitaji::getIdadiById($id);
                        $model->kiasi = GharamaMahitaji::getJumlaById($id);
                        $model->aina_ya_matumizi = $id;


                        if(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::UNGUJA) {
                            $model->product = 'UFZM';
                        }elseif (Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::PEMBA){
                            $model->product = 'PFZM';
                        }
                        $model->kumbukumbu_no = Reference::findBidhaaProduct($model->product);
                        $gl = ProductAccrole::getGlCodeCodeByProductCode($model->product);
                        $glBalance = GlDailyBalance::getCurrentBalance($gl);
                        if($glBalance != null) {
                            $model->budget_id = Budget::getCurrent();
                            if ($model->budget_id == null) {
                                Yii::$app->session->setFlash('', [
                                    'type' => 'warning',
                                    'duration' => 5000,
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
                                    'duration' => 5000,
                                    'icon' => 'fa fa-warning',
                                    'message' => 'Tafadhari ingiza zone kwanza',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);
                                return $this->redirect(['index']);
                            }

                                if($model->kiasi <= $glBalance) {
                                    $model->stakabadhi = UploadedFile::getInstance($model, 'stakabadhi_ya_malipo');

                                    if ($model->stakabadhi != null) {
                                        $model->stakabadhi->saveAs('uploads/receipts/' . $model->stakabadhi . '.' . $model->stakabadhi->extension);
                                        $model->stakabadhi = $model->stakabadhi . '.' . $model->stakabadhi->extension;
                                    }
                                    //$model->wilaya_id = Vituo::getWilayaIDByKituoID($_POST['MalipoMaafisa']['kituo_id']);

                                    $model->save(false);
                                    GharamaMahitaji::updateAll(['status' => GharamaMahitaji::PAID],['hitaji_id'=> $id,'budget_id' => Budget::getCurrent()]);
                                    $role_events = ProductAccrole::getRoleEvents($model->product, $event = EventType::INIT);
                                    if ($role_events != null) {
                                        foreach ($role_events as $role_event) {
                                            if ($role_event->dr_cr_indicator == 'C') {


                                                //saves customer leg
                                                TodayEntry::saveEntry(
                                                    $module = 'MM',
                                                    $model->kumbukumbu_no,
                                                    date('Y-m-d'),
                                                    'Matumizi mengine',
                                                    $model->zone_id,
                                                    $model->kiasi,
                                                    $ind = 'C',
                                                    '',
                                                    $model->product,
                                                    date('Y-m-d'),
                                                    $event,
                                                    $model->aliyeweka
                                                );


                                            } elseif ($role_event->dr_cr_indicator == 'D') {

                                                //saves GL leg
                                                TodayEntry::saveEntry(
                                                    $module = 'MM',
                                                    $model->kumbukumbu_no,
                                                    date('Y-m-d'),
                                                    $role_event->mis_head,
                                                    $model->zone_id,
                                                    $model->kiasi,
                                                    $ind = 'D',
                                                    '',
                                                    $model->product,
                                                    date('Y-m-d'),
                                                    $event,
                                                    $model->aliyeweka
                                                );


                                                //updates GL balance

                                                GlDailyBalance::updateGLBalance($role_event->mis_head, $model->kiasi, 'D');


                                            }
                                        }
                                    }
                                    TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->aliyeweka, 'checker_time' => $model->muda], ['trn_ref_no' => $model->kumbukumbu_no, 'auth_stat' => 'U']);


                                    return $this->redirect(['view', 'id' => $model->id]);
                                }else{
                                    //account has less amount
                                    Yii::$app->session->setFlash('', [
                                        'type' => 'warning',
                                        'duration' => 1500,
                                        'icon' => 'fa fa-warning',
                                        'message' => 'hauna kiasi cha kutosha katika budget ya uendashaji',
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);
                                    return $this->redirect(['index']);

                                }

                        }else{
                            Yii::$app->session->setFlash('', [
                                'type' => 'warning',
                                'duration' => 1500,
                                'icon' => 'fa fa-warning',
                                'message' => 'Tafadhari hakikisha umeweka fedha katika akaunti ya uendeshaji',
                                'positonY' => 'top',
                                'positonX' => 'right'
                            ]);
                            return $this->redirect(['index']);
                        }
                    }
                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 3000,
                        'icon' => 'fa fa-check',
                        'message' => 'umefanikiwa kuthibitisha budget',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['index']);
                }
                else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 5000,
                        'icon' => 'fa fa-warning',
                        'message' => 'haujachagua budget yoyote',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['create-batch']);
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

    /**
     * Creates a new MatumiziMengine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (!Yii::$app->user->isGuest) {
            $model = new MatumiziMengine();
            $model->tarehe = date('Y-m-d');
            $model->aliyeweka = Yii::$app->user->identity->username;
            $model->muda = date('Y-m-d H:i:s');
            $model->status = MatumiziMengine::PENDING;



            if(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::UNGUJA) {
                $model->product = 'UFZM';
            }elseif (Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::PEMBA){
                $model->product = 'PFZM';
            }
            $model->kumbukumbu_no = Reference::findBidhaaProduct($model->product);
            $gl = ProductAccrole::getGlCodeCodeByProductCode($model->product);
            $glBalance = GlDailyBalance::getCurrentBalance($gl);
            if($glBalance != null) {
                $model->budget_id = Budget::getCurrent();
                if ($model->budget_id == null) {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 1500,
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
                        'duration' => 1500,
                        'icon' => 'fa fa-warning',
                        'message' => 'Tafadhari ingiza zone kwanza',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->redirect(['index']);
                }


                if ($model->load(Yii::$app->request->post())) {


                    if($_POST['MatumiziMengine']['kiasi'] <= $glBalance) {
                        $model->stakabadhi = UploadedFile::getInstance($model, 'stakabadhi_ya_malipo');

                        if ($model->stakabadhi != null) {
                            $model->stakabadhi->saveAs('uploads/receipts/' . $model->stakabadhi . '.' . $model->stakabadhi->extension);
                            $model->stakabadhi = $model->stakabadhi . '.' . $model->stakabadhi->extension;
                        }
                        //$model->wilaya_id = Vituo::getWilayaIDByKituoID($_POST['MalipoMaafisa']['kituo_id']);

                        $model->save();
                        $role_events = ProductAccrole::getRoleEvents($model->product, $event = EventType::INIT);
                        if ($role_events != null) {
                            foreach ($role_events as $role_event) {
                                if ($role_event->dr_cr_indicator == 'C') {


                                    //saves customer leg
                                    TodayEntry::saveEntry(
                                        $module = 'MM',
                                        $model->kumbukumbu_no,
                                        date('Y-m-d'),
                                        'Matumizi mengine',
                                        $model->zone_id,
                                        $model->kiasi,
                                        $ind = 'C',
                                        '',
                                        $model->product,
                                        date('Y-m-d'),
                                        $event,
                                        $model->aliyeweka
                                    );


                                } elseif ($role_event->dr_cr_indicator == 'D') {

                                    //saves GL leg
                                    TodayEntry::saveEntry(
                                        $module = 'MM',
                                        $model->kumbukumbu_no,
                                        date('Y-m-d'),
                                        $role_event->mis_head,
                                        $model->zone_id,
                                        $model->kiasi,
                                        $ind = 'D',
                                        '',
                                        $model->product,
                                        date('Y-m-d'),
                                        $event,
                                        $model->aliyeweka
                                    );


                                    //updates GL balance

                                    GlDailyBalance::updateGLBalance($role_event->mis_head, $model->kiasi, 'D');


                                }
                            }
                        }
                        TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->aliyeweka, 'checker_time' => $model->muda], ['trn_ref_no' => $model->kumbukumbu_no, 'auth_stat' => 'U']);


                        return $this->redirect(['view', 'id' => $model->id]);
                    }else{
                        //account has less amount
                        Yii::$app->session->setFlash('', [
                            'type' => 'warning',
                            'duration' => 1500,
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
                    'duration' => 1500,
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
                            $module = 'MM',
                            $model->kumbukumbu_no,
                            date('Y-m-d'),
                            'Matumizi mengine',
                            $model->zone_id,
                            $model->kiasi,
                            $ind = 'D',
                            '',
                            $model->product,
                            date('Y-m-d'),
                            $event,
                            $model->aliyeweka
                        );


                    } elseif ($role_event->dr_cr_indicator == 'C') {

                        //saves GL leg
                        TodayEntry::saveEntry(
                            $module = 'MM',
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
                            $model->aliyeweka
                        );


                        //updates GL balance

                        GlDailyBalance::updateGLBalance($role_event->mis_head, $model->kiasi, 'C');


                    }
                }
            }

            TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->aliyeweka, 'checker_time' => $model->muda], ['trn_ref_no' => $model->kumbukumbu_no, 'auth_stat' => 'U']);

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
     * Updates an existing MatumiziMengine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->aliyeweka = Yii::$app->user->identity->username;
        $model->muda = date('Y-m-d H:i');

        if ($model->load(Yii::$app->request->post())) {
            if(UploadedFile::getInstance($model, 'stakabadhi_ya_malipo') != null) {
                $model->stakabadhi = UploadedFile::getInstance($model, 'stakabadhi_ya_malipo');

                if ($model->stakabadhi != null) {
                    $model->stakabadhi->saveAs('uploads/receipts/' . $model->stakabadhi . '.' . $model->stakabadhi->extension);
                    $model->stakabadhi = $model->stakabadhi . '.' . $model->stakabadhi->extension;
                    $model->save();
                } else {
                    $model->save();
                }
            }else{
                $model->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }




    /**
     * Deletes an existing MatumiziMengine model.
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
     * Finds the MatumiziMengine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MatumiziMengine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MatumiziMengine::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
