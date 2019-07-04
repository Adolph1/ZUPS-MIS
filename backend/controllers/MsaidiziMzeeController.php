<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\MsadiziWazeeWengine;
use backend\models\Mzee;
use backend\models\MzeeMsaidiziWengine;
use backend\models\MzeeSearch;
use common\models\LoginForm;
use Yii;
use backend\models\MsaidiziMzee;
use backend\models\MsaidiziMzeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * MsaidiziMzeeController implements the CRUD actions for MsaidiziMzee model.
 */
class MsaidiziMzeeController extends Controller
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
     * Lists all MsaidiziMzee models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
        $searchModel = new MsaidiziMzeeSearch();
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

    /**
     * Displays a single MsaidiziMzee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
        $mzee = new Mzee();
        $wazee = new MsadiziWazeeWengine();
        return $this->render('view', [
            'model' => $this->findModel($id),'mzee' => $mzee,'wazee' => $wazee
        ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionWithFinger()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('DataClerk')) {
                $searchModel = new MsaidiziMzeeSearch();
                $dataProvider = $searchModel->searchWithFinger(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya wasaidizi wenye finger print', 'Wasaidizi', 'Index', '', '');
                return $this->render('with_finger', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }else {
                $searchModel = new MsaidiziMzeeSearch();
                $dataProvider = $searchModel->searchWithFingerAll(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya wasaiidizi wenye finger print', 'Wazee', 'Index', '', '');
                return $this->render('with_finger', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

        /*       if (!Yii::$app->user->isGuest) {
               $searchModel = new MsaidiziMzeeSearch();
               $dataProvider = $searchModel->searchWithFinger(Yii::$app->request->queryParams);

               return $this->render('with_finger', [
                   'searchModel' => $searchModel,
                   'dataProvider' => $dataProvider,
               ]);
               }
               else{
                   $model = new LoginForm();
                   return $this->redirect(['site/login',
                       'model' => $model,
                   ]);
               }*/

    }

    /**
     * Creates a new MsaidiziMzee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate1()
    {
        if (!Yii::$app->user->isGuest) {
        $model = new MsaidiziMzee();

        $model->aliyemuweka = Yii::$app->user->identity->username;
        $model->muda =  date('Y-m-d H:i');


        if ($model->load(Yii::$app->request->post())) {
            //check if the ID has already been used

            $msaidizi = MsaidiziMzee::findOne(['aina_ya_kitambulisho'=> $_POST['MsaidiziMzee']['aina_ya_kitambulisho'],'nambari_ya_kitambulisho' => $_POST['MsaidiziMzee']['nambari_ya_kitambulisho'] ]);
            $mzee = Mzee::findOne(['aina_ya_kitambulisho'=> $_POST['MsaidiziMzee']['aina_ya_kitambulisho'],'nambar' => $_POST['MsaidiziMzee']['nambari_ya_kitambulisho'] ]);

           if($msaidizi == null && $mzee == null) {
               $model->tarehe_kuzaliwa = date('Y-m-d', strtotime($_POST['MsaidiziMzee']['tarehe_kuzaliwa']));
               $model->msaidizi_picha = UploadedFile::getInstance($model, 'msaidizi_picha');

               if ($model->msaidizi_picha != null) {
                   $model->msaidizi_picha->saveAs('uploads/wasaidizi/' . date('YmdHi') . '.' . $model->msaidizi_picha->extension);
                   $model->picha = date('YmdHi') . '.' . $model->msaidizi_picha->extension;
                   $model->status = MsaidiziMzee::ACTIVE;
                   if ($model->save()) {
                       //Mzee::updateAll(['msaidizi_id' => $model->id],['id' => $model->mzee_id]);
                       Yii::$app->session->setFlash('', [
                           'type' => 'warning',
                           'duration' => 5000,
                           'icon' => 'fa fa-check',
                           'message' => 'Usajili umekamilika',
                           'positonY' => 'top',
                           'positonX' => 'right'
                       ]);
                       return $this->redirect(['view', 'id' => $model->id]);
                   } else {
                       print_r('not saved');
                   }
               } else {
                   Yii::$app->session->setFlash('', [
                       'type' => 'warning',
                       'duration' => 5000,
                       'icon' => 'fa fa-warning',
                       'message' => 'Ingiza picha na power of attorney',
                       'positonY' => 'top',
                       'positonX' => 'right'
                   ]);
                   return $this->render('create', [
                       'model' => $model,
                   ]);
               }
           }else{
               Yii::$app->session->setFlash('', [
                   'type' => 'warning',
                   'duration' => 5000,
                   'icon' => 'fa fa-warning',
                   'message' => 'Kitambulisho hiki kimekwishatumika',
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
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('createNextOfKin')){

            $model = new MsaidiziMzee();
            $model->scenario = 'create';
            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            $model->aliyemuweka = Yii::$app->user->identity->username;
            $model->muda =  date('Y-m-d H:i');
            if ($model->load(Yii::$app->request->post())) {


                $model->tarehe_kuzaliwa = date('Y-m-d', strtotime($_POST['MsaidiziMzee']['tarehe_kuzaliwa']));
                $model->status = MsaidiziMzee::ACTIVE;
                $model->msaidizi_picha = UploadedFile::getInstance($model, 'msaidizi_picha');


                if($model->msaidizi_picha !=null) {
                    $model->msaidizi_picha->saveAs('uploads/wasaidizi/' . date('YmdHi') . '.' . $model->msaidizi_picha->extension);
                    $model->picha = date('YmdHi') . '.' . $model->msaidizi_picha->extension;
                }
                if ($model->save()) {

                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'message' => 'Usajili umekamilika',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'message' => 'Usajili Haujakamilika',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }

            return $this->render('create', [
                'model' => $model,
            ]);

            }

            else{
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 1500,
                    'icon' => 'fa fa-check',
                    'message' => 'Hauna Uwezo',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['index']);
            }


        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing MsaidiziMzee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
        $model = $this->findModel($id);
        $model->aliyemuweka = Yii::$app->user->identity->username;
        $model->tarehe_kuzaliwa = date('d-m-Y',strtotime($model->tarehe_kuzaliwa));
        $beforeID = $model->nambari_ya_kitambulisho;

        $model->muda =  date('Y-m-d H:i');

        if ($model->load(Yii::$app->request->post())) {

            if($beforeID != trim($model->nambari_ya_kitambulisho)) {
                $msaidizi = MsaidiziMzee::findOne(['aina_ya_kitambulisho' => $_POST['MsaidiziMzee']['aina_ya_kitambulisho'], 'nambari_ya_kitambulisho' => $_POST['MsaidiziMzee']['nambari_ya_kitambulisho']]);
                $mzee = Mzee::findOne(['aina_ya_kitambulisho' => $_POST['MsaidiziMzee']['aina_ya_kitambulisho'], 'nambar' => $_POST['MsaidiziMzee']['nambari_ya_kitambulisho']]);

                if ($msaidizi == null && $mzee == null) {
                    $model->tarehe_kuzaliwa = date('Y-m-d', strtotime($_POST['MsaidiziMzee']['tarehe_kuzaliwa']));

                    $model->msaidizi_picha = UploadedFile::getInstance($model, 'msaidizi_picha');

                    if ($model->msaidizi_picha != null) {
                        $model->msaidizi_picha->saveAs('uploads/wasaidizi/' . date('YmdHi') . '.' . $model->msaidizi_picha->extension);
                        $model->picha = date('YmdHi') . '.' . $model->msaidizi_picha->extension;

                        if ($model->save(false)) {
                            Mzee::updateAll(['msaidizi_id' => $model->id], ['id' => $model->mzee_id]);
                            Yii::$app->session->setFlash('', [
                                'type' => 'warning',
                                'duration' => 1500,
                                'icon' => 'fa fa-check',
                                'message' => 'Marekebisho yamekamilika',
                                'positonY' => 'top',
                                'positonX' => 'right'
                            ]);
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    } else {
                        $model->status = MsaidiziMzee::ACTIVE;
                        if ($model->save()) {
                            Mzee::updateAll(['msaidizi_id' => $model->id], ['id' => $model->mzee_id]);

                            Yii::$app->session->setFlash('', [
                                'type' => 'warning',
                                'duration' => 1500,
                                'icon' => 'fa fa-check',
                                'message' => 'Usajili umekamilika',
                                'positonY' => 'top',
                                'positonX' => 'right'
                            ]);
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    }
                } else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 1500,
                        'icon' => 'fa fa-warning',
                        'message' => 'Kitambulisho hiki kimekwishatumika',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }else{
                $model->save(false);

                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-check',
                    'message' => 'Usajili umekamilika',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['view', 'id' => $model->id]);
            }
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
     * Deletes an existing MsaidiziMzee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
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
     * Finds the MsaidiziMzee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MsaidiziMzee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MsaidiziMzee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
