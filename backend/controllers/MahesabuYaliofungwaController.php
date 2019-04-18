<?php

namespace backend\controllers;

use backend\models\AccdailyBal;
use backend\models\CashierAccount;
use backend\models\MahesabuBreakdown;
use backend\models\Marejesho;
use Yii;
use backend\models\MahesabuYaliofungwa;
use backend\models\MahesabuYaliofungwaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MahesabuYaliofungwaController implements the CRUD actions for MahesabuYaliofungwa model.
 */
class MahesabuYaliofungwaController extends Controller
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
     * Lists all MahesabuYaliofungwa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MahesabuYaliofungwaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all MahesabuYaliofungwa models.
     * @return mixed
     */
    public function actionClosed()
    {
        $searchModel = new MahesabuYaliofungwaSearch();
        $dataProvider = $searchModel->searchClosed(Yii::$app->request->queryParams);

        return $this->render('closed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all MahesabuYaliofungwa models.
     * @return mixed
     */
    public function actionPending()
    {
        $searchModel = new MahesabuYaliofungwaSearch();
        $dataProvider = $searchModel->searchPending(Yii::$app->request->queryParams);

        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MahesabuYaliofungwa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $marejesho = new Marejesho();
        $marejesho->mahesabu_id = $id;

        return $this->render('view', [
            'model' => $this->findModel($id),'marejesho' => $marejesho
        ]);
    }

    /**
     * Creates a new MahesabuYaliofungwa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MahesabuYaliofungwa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MahesabuYaliofungwa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->aliyepokea = Yii::$app->user->identity->username;
        $model->muda = date('Y-m-d H:i:s');


        $dailbalance = AccdailyBal::find()->where(['account' => CashierAccount::geAccountByUserId($model->cashier_id)])->orderBy(['id'=>SORT_DESC])->one();;

        if ($model->load(Yii::$app->request->post())) {

            $kilichobaki = $_POST['MahesabuYaliofungwa']['kiasi_alichopewa']-($_POST['MahesabuYaliofungwa']['kiasi_alichorudisha']+$_POST['MahesabuYaliofungwa']['kiasi_kilichotumika']);
            if($kilichobaki == 0.00) {
                $model->status = 'C';
            }else{
                $model->status = 'C';
                $breakdown = new MahesabuBreakdown();
                $breakdown->kiasi_kilichobaki = $kilichobaki;
                $breakdown->mahesabu_id = $model->id;
                $breakdown->tarehe = date('Y-m-d');
                $breakdown->save();
             }
            $model->save();

                AccdailyBal::updateAccountBalance($dailbalance->account, $model->kiasi_alichorudisha, 'D');
                return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MahesabuYaliofungwa model.
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
     * Finds the MahesabuYaliofungwa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MahesabuYaliofungwa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MahesabuYaliofungwa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
