<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\Budget;
use backend\models\KituoMonthlyBalances;
use backend\models\Malipo;
use backend\models\RejectionReason;
use backend\models\ZupsBudgetApproval;
use Yii;
use backend\models\ZupsBudget;
use backend\models\ZupsBudgetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ZupsBudgetController implements the CRUD actions for ZupsBudget model.
 */
class ZupsBudgetController extends Controller
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
     * Lists all ZupsBudget models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ZupsBudgetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ZupsBudget model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $monthlyZupsBudget = KituoMonthlyBalances::find()->where(['month' => $model->mwezi, 'year' => $model->mwaka])->sum('allocated_amount');
        $model->jumla_iliyoombwa = Budget::getTotalPerMainBudgetID($id) + $monthlyZupsBudget;
        $model->jumla_iliyotolewa = Budget::getTotalPerMainBudgetID($id) + $monthlyZupsBudget;
        $sababu = new RejectionReason();
        return $this->render('view', [
            'model' => $model,'sababu' => $sababu
        ]);
    }




    /**
     * Displays a single ZupsBudget model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionReviewApproval($id)
    {
        $model = $this->findModel($id);
        if(ZupsBudget::updateAll(['status' => ZupsBudget::REVIEWED],['id' => $id])) {


            $stages = new ZupsBudgetApproval();
            $stages->zups_budget_id = $id;
            $stages->maker = Yii::$app->user->identity->username;
            $stages->muda = date('Y-m-d H:i:s');
            $stages->stage = ZupsBudget::REVIEWED;
            Budget::updateAll(['status' => Budget::WAITING_FUND],['zups_budget_id' => $id]);

            if($stages->save(false)) {

                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-check',
                    'message' => Yii::t('app', 'Umefakiwa kuthibitisha mapitio ya budget'),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 1500,
                'icon' => 'fa fa-check',
                'message' => Yii::t('app', 'haujafanikiwa kuthibitisha mapitio ya budget'),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);


            return $this->redirect(['view', 'id' => $model->id]);
        }
    }



    /**
     * Displays a single ZupsBudget model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionInspectApproval($id)
    {
        $model = $this->findModel($id);
        if(ZupsBudget::updateAll(['status' => ZupsBudget::APPROVED],['id' => $id])) {


            $stages = new ZupsBudgetApproval();
            $stages->zups_budget_id = $id;
            $stages->maker = Yii::$app->user->identity->username;
            $stages->muda = date('Y-m-d H:i:s');
            $stages->stage = ZupsBudget::APPROVED;

            if($stages->save(false)) {



                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-check',
                    'message' => Yii::t('app', 'Umefakiwa kuthibitisha mapitio ya budget'),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 1500,
                'icon' => 'fa fa-check',
                'message' => Yii::t('app', 'haujafanikiwa kuthibitisha mapitio ya budget'),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);


            return $this->redirect(['view', 'id' => $model->id]);
        }
    }


    /**
     * Creates a new ZupsBudget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ZupsBudget();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ZupsBudget model.
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

    public function actionFundBudget($id)
    {
        $model = $this->findModel($id);
        $model->status = ZupsBudget::FUNDED;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 3000,
                'icon' => 'fa fa-check',
                'message' => 'Fedha zimeingizwa ZUPS kikamilifu',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            $budgetApprovals = new ZupsBudgetApproval();
            $budgetApprovals->zups_budget_id = $id;
            $budgetApprovals->stage = ZupsBudget::FUNDED;
            $budgetApprovals->maker = Yii::$app->user->identity->username;
            $budgetApprovals->muda = date('Y-m-d H:i:s');
            $budgetApprovals->save();
            Audit::setActivity('Ameingiza fedha za budget kuu ya mwezi' .$model->mwezi. ',' .$model->mwaka,'Budget Kuu','Fund Budget','','');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Deletes an existing ZupsBudget model.
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
     * Finds the ZupsBudget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ZupsBudget the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ZupsBudget::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
