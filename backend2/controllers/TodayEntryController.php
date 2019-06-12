<?php

namespace backend\controllers;

use backend\models\CashierAccount;
use backend\models\EventType;
use common\models\LoginForm;
use Yii;
use backend\models\TodayEntry;
use backend\models\TodayEntrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TodayEntryController implements the CRUD actions for TodayEntry model.
 */
class TodayEntryController extends Controller
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
     * Lists all TodayEntry models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest) {
        $searchModel = new TodayEntrySearch();
        $dataProvider = $searchModel->search();

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

    public function actionCashier()
    {
        if(!Yii::$app->user->isGuest) {
        $searchModel = new TodayEntrySearch();
        $dataProvider = $searchModel->searchByAccount(CashierAccount::geAccountByUserId(Yii::$app->user->identity->user_id));

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

    //gets unauthorised transactions
    public function actionUnauthorised()
    {
        if(!Yii::$app->user->isGuest) {
        $searchModel = new TodayEntrySearch();
        $dataProvider = $searchModel->searchUnauthorised();

        return $this->render('unauthorised', [
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

    //gets unauthorised reversed
    public function actionReversed()
    {
        if(!Yii::$app->user->isGuest) {
        $searchModel = new TodayEntrySearch();
        $dataProvider = $searchModel->searchreversed();

        return $this->render('reversed', [
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
     * Displays a single TodayEntry model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!Yii::$app->user->isGuest) {
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
     * Creates a new TodayEntry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->isGuest) {
        $model = new TodayEntry();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing TodayEntry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->isGuest) {
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
    public function actionStatement($id,$start_date,$end_date)
    {
        $statements=$this->loadStatement($id,$start_date,$end_date);
        if($statements!=null){
            $balance=0.00;
            echo '<table class="table table-condensed">';
            echo '<tr><th>Date</th><th>Reference</th><th>Description</th><th>Credit</th><th>Debit</th><th>Balance</th></tr>';
            foreach ($statements as $statement){
                echo '<tr>';
                echo '<td>'.$statement->trn_dt.'</td>';
                echo '<td>'.$statement->trn_ref_no.'</td>';
                if($statement->event==EventType::INIT){
                    echo '<td>New Transaction</td>';
                }elseif ($statement->event==EventType::LDS){
                    echo '<td>Disbursement</td>';
                } elseif ($statement->event==EventType::LQD){
                    echo '<td>Repayment</td>';
                }
                elseif ($statement->event==EventType::RVS){
                    echo '<td>Reversal</td>';
                }else{
                    echo '<td></td>';
                }
                if($statement->drcr_ind=='C'){
                    echo '<td>'.$statement->amount.'</td>';
                    echo '<td>0.00</td>';
                    echo '<td>'.$balance=$balance+$statement->amount.'</td>';
                }elseif ($statement->drcr_ind=='D'){
                    echo '<td>0.00</td>';
                    echo '<td>'.$statement->amount.'</td>';
                    echo '<td>'.$balance=$balance-$statement->amount.'</td>';
                }
                echo '</tr>';
            }

            echo '</table>';
        }
    }

    /**
     * Deletes an existing TodayEntry model.
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
     * Finds the TodayEntry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TodayEntry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TodayEntry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function loadStatement($account,$start_date,$end_date)
    {
        if (($model = TodayEntry::find()->where(['ac_no'=>$account])->andWhere(['between','trn_dt',$start_date,$end_date])->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
