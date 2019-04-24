<?php

namespace backend\controllers;

use backend\models\Budget;
use Yii;
use backend\models\OfficeSupervisor;
use backend\models\OfficeSupervisorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OfficeSupervisorController implements the CRUD actions for OfficeSupervisor model.
 */
class OfficeSupervisorController extends Controller
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
     * Lists all OfficeSupervisor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OfficeSupervisorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OfficeSupervisor model.
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
     * Creates a new OfficeSupervisor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $openedBudget = $this->findBudget();
        if($openedBudget == false){
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 4500,
                'icon' => 'fa fa-warning',
                'message' => 'Budget ya mwezi huu haijaandaliwa bado',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index']);
        }else {
            $model = new OfficeSupervisor();
            $budget = Budget::CurrentBudget();
            $model->budget_number = $budget->kumbukumbu_no;
            $model->budget_id = $budget->id;
            $model->aliyeweka = Yii::$app->user->identity->username;
            $model->muda = date('Y-m-d H:i');
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Budget::calculateBudget($model->budget_id,$model->kiasi);
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 4500,
                    'icon' => 'fa fa-check',
                    'message' => 'Umefanikiwa kuingiza matumizi',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing OfficeSupervisor model.
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
     * Deletes an existing OfficeSupervisor model.
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
     * Finds the OfficeSupervisor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OfficeSupervisor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OfficeSupervisor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function findBudget()
    {
        if (($model = Budget::findOne(['status' => Budget::OPEN])) !== null) {
            return $model;
        } else {
            return false;
        }
    }
}
