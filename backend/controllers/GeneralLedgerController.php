<?php

namespace backend\controllers;

use backend\models\Wafanyakazi;
use Yii;
use backend\models\GeneralLedger;
use backend\models\GeneralLedgerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\GlDailyBalance;

/**
 * GeneralLedgerController implements the CRUD actions for GeneralLedger model.
 */
class GeneralLedgerController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all GeneralLedger models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GeneralLedgerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeneralLedger model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GeneralLedger model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GeneralLedger();
        $model->record_status='O';
        $model->auth_stat='U';
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_stamptime=date('Y-m-d:h:i');
        $model->mod_no=1;
        $model->zone_id = Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->gl_code]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GeneralLedger model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->zone_id = Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->gl_code]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GeneralLedger model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }




    public function actionFetchCredit($id)
    {
        $countGls = GeneralLedger::find()
            ->where(['!=','gl_code',$id])
            ->count();

        $gls = GeneralLedger::find()
            ->where(['!=','gl_code',$id])
            ->orderBy('gl_code DESC')
            ->all();

        if($countGls>0){
            echo "<option> --Select-- </option>";
            foreach($gls as $gl){

                echo "<option value='".$gl->gl_code."'>".$gl->gl_description."</option>";
            }
        }
        else{
            echo "<option> </option>";
        }

    }

    /**
     * Finds the GeneralLedger model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GeneralLedger the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeneralLedger::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
