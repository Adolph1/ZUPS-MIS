<?php

namespace backend\controllers;

use Yii;
use backend\models\KituoMonthlyBalances;
use backend\models\KituoMonthlyBalancesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KituoMonthlyBalancesController implements the CRUD actions for KituoMonthlyBalances model.
 */
class KituoMonthlyBalancesController extends Controller
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
     * Lists all KituoMonthlyBalances models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KituoMonthlyBalancesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KituoMonthlyBalances model.
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
     * Creates a new KituoMonthlyBalances model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KituoMonthlyBalances();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing KituoMonthlyBalances model.
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
     * Deletes an existing KituoMonthlyBalances model.
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
     * Finds the KituoMonthlyBalances model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KituoMonthlyBalances the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KituoMonthlyBalances::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetBalance($id)
    {
        $model = KituoMonthlyBalances::find()->where(['kituo_id' => $id])->orderBy(['id'=>SORT_DESC])->one();
        if($model != null){
            return $model->balance;
        }else{
            return 0.00;
        }
    }

    public function actionGetBreakdown($id)
    {
        $fmt = Yii::$app->formatter;
        $model = KituoMonthlyBalances::find()->where(['kituo_id' => $id])->orderBy(['id'=>SORT_DESC])->limit(3)->offset(1)->all();
        if($model != null){
            $balance = 0.00;
            echo '<table class="table table-condensed"> <tr class="warning"><td>Mwezi/Mwaka</td><td>Bajeti ya mwezi</td><td>Bajeti Jumla ya kituo</td><td>Kiasi Kilicholipwa</td><td>Bakaa</td></tr>';
            foreach ($model as $md){
                //$balance = $md->balance;
                //$balance = $md->balance - $balance;
                echo '<tr><td>'.$md->month.'/'.$md->year.'</td><td>'.$fmt->asDecimal($md->monthly_eligible_balance,2).'</td><td>'.$fmt->asDecimal($md->allocated_amount,2).'</td><td>'.$fmt->asDecimal($md->paid_amount,2).'</td><td>'.$fmt->asDecimal($md->balance,2).'</td></tr>';

            }
            echo '</table>';
        }else{
            return 0.00;
        }
    }
}
