<?php

namespace backend\controllers;

use backend\models\AccdailyBal;
use backend\models\Audit;
use common\models\LoginForm;
use Yii;
use backend\models\CashierAccount;
use backend\models\CashierAccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CashierAccountController implements the CRUD actions for CashierAccount model.
 */
class CashierAccountController extends Controller
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
                    'close' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CashierAccount models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('viewCashierAccount')) {
                $searchModel = new CashierAccountSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                Audit::setActivity('ameangalia orodha ya account za makarani ', 'CashierAccount', 'Index', '', '', '');
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => 'hauna ruhusa ya kuona akaunti za makarani',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['site/login']);
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
     * Displays a single CashierAccount model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('viewCashierAccount')) {
                $model = $this->findModel($id);
                Audit::setActivity('ameangalia account ya karani - ' . $model->account, 'CashierAccount', 'View', '', '', '');
                return $this->render('view', [
                    'model' => $model,
                ]);
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => 'hauna ruhusa ya kuona akaunti za makarani',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['site/login']);
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
     * Creates a new CashierAccount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('createCashierAccount')) {
                $model = new CashierAccount();
                $model->maker_id = Yii::$app->user->identity->username;
                $model->maker_time = date('Y-m-d H:i');
                $model->account = CashierAccount::findLast();
                $model->current_balance = 0.00;
                $model->opening_balance = 0.00;

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    Audit::setActivity('amefungua account mpya ya karani - ' . $model->account, 'CashierAccount', 'Create', '', '', '');
                    return $this->redirect(['view', 'id' => $model->id]);
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
                    'message' => 'hauna uwezo wa kuunda akaunti ya karani',
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

    /**
     * Updates an existing CashierAccount model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('createCashierAccount')) {
                $model = $this->findModel($id);
                $model->maker_id = Yii::$app->user->identity->username;
                $model->maker_time = date('Y-m-d H:i');
                $beforesave = $model->attributes;

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    $aftersave = $model->attributes;
                    Audit::setActivity('Updated', 'CashierAccount', 'Update', $beforesave, $aftersave);
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => 'hauna uwezo wa kuunda akaunti ya karani',
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


    public function actionGetAccount($id)
    {
        $model = CashierAccount::find()->where(['cashier_id' => $id])->andWhere(['status'=> null])->one();
        if($model !=null){
            return $model->account;
        }

    }

    /**
     * Deletes an existing CashierAccount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
   /* public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/



   //closing cashier account

    public function actionClose($id)
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('closeCashierAccount')) {
                $model = $this->findModel($id);
                $checkBalance = AccdailyBal::getCurrentBalance($model->account);
                if ($checkBalance != null) {
                    if ($checkBalance == 0.00) {
                        $model->status = CashierAccount::CLOSED;
                        $model->save();
                        Yii::$app->session->setFlash('', [
                            'type' => 'success',
                            'duration' => 1500,
                            'icon' => 'fa fa-check',
                            'message' => 'Umefanikiwa kuifunga account',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        Audit::setActivity('Amefunga account - ' . $model->account, 'CashierAccount', 'Close', '', '');

                        return $this->redirect(['index']);
                    } else {
                        Yii::$app->session->setFlash('', [
                            'type' => 'warning',
                            'duration' => 1500,
                            'icon' => 'fa fa-warning',
                            'message' => 'account haiwezi kufungwa kwa kuwa ina fedha',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);


                        return $this->redirect(['index']);
                    }
                } else {
                    $model->status = CashierAccount::CLOSED;
                    $model->save();
                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'message' => 'Umefanikiwa kuifunga account',
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
                    'message' => 'Hauna ruhusa ya kuifunga akaunti ya karani',
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

    /**
     * Finds the CashierAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CashierAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CashierAccount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
