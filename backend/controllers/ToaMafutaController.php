<?php

namespace backend\controllers;

use backend\models\BidhaaZilizobaki;
use backend\models\Budget;
use backend\models\VehicleManagement;
use Yii;
use backend\models\ToaMafuta;
use backend\models\ToaMafutaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ToaMafutaController implements the CRUD actions for ToaMafuta model.
 */
class ToaMafutaController extends Controller
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
     * Lists all ToaMafuta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ToaMafutaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ToaMafuta model.
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
     * Creates a new ToaMafuta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ToaMafuta();
        $gar = new VehicleManagement();
        $model->budget_id = Budget::getCurrent();
        $model->maker_id = Yii::$app->user->identity->username;
        $model->maker_time = date('Y-m-d H:i:s');


        if ($model->load(Yii::$app->request->post()) ) {

            if($_POST['ToaMafuta']['budget_qty']>=$_POST['ToaMafuta']['kiasi']){


                //checks sum of out fuel as per budget
                $given = ToaMafuta::find()->where(['budget_id' => $model->budget_id,'bidhaa_id' => $_POST['ToaMafuta']['bidhaa_id']])->sum('kiasi');

                if(($given + $_POST['ToaMafuta']['kiasi'] )<= $_POST['ToaMafuta']['budget_qty']){
                    $model->save();
                    BidhaaZilizobaki::lessStoke($model->bidhaa_id,$model->kiasi);
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    Yii::$app->session->setFlash('', [
                        'type' => 'danger',
                        'duration' => 5000,
                        'icon' => 'fa fa-warning',
                        'message' => 'Idadi ya lita haiwezi zidi iliyowekwa kwenye budget',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->render('create', [
                        'model' => $model,'gar' => $gar
                    ]);
                }


            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 5000,
                    'icon' => 'fa fa-warning',
                    'message' => 'Idadi ya lita haiwezi zidi iliyowekwa kwenye budget',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->render('create', [
                    'model' => $model,'gar' => $gar
                ]);
            }

        }

        return $this->render('create', [
            'model' => $model,'gar' => $gar
        ]);
    }

    /**
     * Updates an existing ToaMafuta model.
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
     * Deletes an existing ToaMafuta model.
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
     * Finds the ToaMafuta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ToaMafuta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ToaMafuta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
