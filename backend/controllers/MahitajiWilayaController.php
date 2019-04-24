<?php

namespace backend\controllers;

use backend\models\Mahitaji;
use Yii;
use backend\models\MahitajiWilaya;
use backend\models\MahitajiWilayaSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MahitajiWilayaController implements the CRUD actions for MahitajiWilaya model.
 */
class MahitajiWilayaController extends Controller
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
     * Lists all MahitajiWilaya models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MahitajiWilayaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MahitajiWilaya model.
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
     * Creates a new MahitajiWilaya model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MahitajiWilaya();
        $model->muda = date('Y-m-d H:i');
        $model->aliyeweka = Yii::$app->user->identity->username;

        if ($model->load(Yii::$app->request->post())) {
            $array = $_POST['MahitajiWilaya']['mahitaji'];
            if($array != null) {
                foreach ($array as $hitaji) {
                    $exist = MahitajiWilaya::findOne(['wilaya_id' => $_POST['MahitajiWilaya']['wilaya_id'],'hitaji_id' => $hitaji]);
                    if($exist == null) {
                        $mw = new MahitajiWilaya();
                        $mw->wilaya_id = $_POST['MahitajiWilaya']['wilaya_id'];
                        $mw->hitaji_id = $hitaji;
                        //print_r($mw);
                        // exit;
                        $mw->muda = date('Y-m-d H:i');
                        $mw->aliyeweka = Yii::$app->user->identity->username;
                        $mw->save();

                        return $this->redirect(['update', 'id' => $mw->id]);
                    }else{
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
                }

            }else{
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

    /**
     * Updates an existing MahitajiWilaya model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post())) {
            $array = $_POST['MahitajiWilaya']['mahitaji'];
            $exist = MahitajiWilaya::findAll(['wilaya_id' => $_POST['MahitajiWilaya']['wilaya_id']]);
            if($exist != null) {
                MahitajiWilaya::deleteAll(['wilaya_id' => $model->wilaya_id]);
            }
            if($array != null) {

                foreach ($array as $hitaji) {

                        $mw = new MahitajiWilaya();
                        $mw->wilaya_id =  $_POST['MahitajiWilaya']['wilaya_id'];
                        $mw->hitaji_id = $hitaji;
                        $mw->muda = date('Y-m-d H:i');
                        $mw->aliyeweka = Yii::$app->user->identity->username;
                        //print_r($mw);
                        // exit;
                        $mw->save();



                }
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 4500,
                    'icon' => 'fa fa-check',
                    'message' => 'umafanikiwa kuingiza mahitaji',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['update', 'id' => $mw->id]);

            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            $model->mahitaji = ArrayHelper::map(MahitajiWilaya::find()->where(['wilaya_id' => $model->wilaya_id])->all(), 'id', 'hitaji_id');
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MahitajiWilaya model.
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
     * Finds the MahitajiWilaya model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MahitajiWilaya the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MahitajiWilaya::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
