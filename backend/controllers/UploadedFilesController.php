<?php

namespace backend\controllers;

use backend\models\Budget;
use backend\models\EventType;
use backend\models\GlDailyBalance;
use backend\models\MalipoMaafisa;
use backend\models\ProductAccrole;
use backend\models\Reference;
use backend\models\TodayEntry;
use backend\models\Vituo;
use backend\models\Wafanyakazi;
use backend\models\Zone;
//use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;
use backend\models\UploadedFiles;
use backend\models\UploadedFilesSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UploadedFilesController implements the CRUD actions for UploadedFiles model.
 */
class UploadedFilesController extends Controller
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
     * Lists all UploadedFiles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UploadedFilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UploadedFiles model.
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
     * Creates a new UploadedFiles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UploadedFiles();
        $model->name = UploadedFile::getInstance($model, 'file');

        if ($model->load(Yii::$app->request->post())) {
            if($model->name != null){
                $model->name->saveAs('uploads/' . date('YmdHis') . '.' . $model->name->extension);
                $model->name = date('YmdHis') . '.' . $model->name->extension;
                $model->uploaded_by = Yii::$app->user->identity->username;
                $model->time_uploaded = date('Y-m-d H:i:s');
                $model->uploaded_date = date('Y-m-d');
                $model->status = UploadedFiles::UPLOADED;
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 5000,
                    'icon' => 'fa fa-warning',
                    'message' => 'hujafanikiwa kupakia miamala',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['malipo-maafisa/create']);
            }

        }


    }

    /**
     * Updates an existing UploadedFiles model.
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
     * Updates an existing UploadedFiles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionProcess($id)
    {
        $model1 = $this->findModel($id);
        $inputFile = 'uploads/'.$model1->name;

        try{

            $inputFileType = IOFactory::identify($inputFile);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel  = $objReader->load($inputFile);
            //print_r($objPHPExcel);
            //exit;

        }catch (Exception $e){
            die('Error');
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for($row =1 ; $row<= $highestRow ; $row++){
            $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);

            if($row == 1){
                continue;
            }

            $model = new MalipoMaafisa();
            $fmt = Yii::$app->formatter;
            $model->jina_kamili = $rowData[0][2];
            $model->kiasi = $rowData[0][3];
            $model->tarehe_ya_malipo = date('Y-m-d');
            $model->kituo_id = $rowData[0][5];
            $model->kazi = $rowData[0][6];
            if($model->jina_kamili == null){
                continue;
            }

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
                        'duration' => 1500,
                        'icon' => 'fa fa-warning',
                        'message' => 'Tafadhari ingiza budget kwanza',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->redirect(['view', 'id' => $model->id]);
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
                    return $this->redirect(['view', 'id' => $model->id]);
                }


                    if($model->kiasi <= $glBalance) {
                        $model->wilaya_id = Vituo::getWilayaIDByKituoID($model->kituo_id);

                        $model->save(false);
                        Yii::$app->session->setFlash('', [
                            'type' => 'success',
                            'duration' => 5000,
                            'icon' => 'fa fa-check',
                            'message' => 'Umefanikiwa kulipa maafisa '.$row,
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                       // print_r($model);
                       // exit;
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


                       //
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
                        return $this->redirect(['view', 'id' => $model->id]);

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
                return $this->redirect(['view', 'id' => $model->id]);
            }


        UploadedFiles::updateAll(['status' => UploadedFiles::PROCESSED],['id' =>$id]);
        }

        return $this->redirect(['view', 'id' => $id]);

    }

    /**
     * Deletes an existing UploadedFiles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->status == UploadedFiles::PROCESSED){
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 1500,
                'icon' => 'fa fa-warning',
                'message' => 'hauwezi futa miamala iliyofanyiwa kazi',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
        }else {
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the UploadedFiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UploadedFiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UploadedFiles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
