<?php

namespace backend\controllers;

use backend\models\EventType;
use backend\models\GeneralLedger;
use backend\models\GlDailyBalance;
use backend\models\Product;
use backend\models\Reference;
use backend\models\TodayEntry;
use backend\models\Wafanyakazi;
use common\models\LoginForm;
use Yii;
use backend\models\CashBook;
use backend\models\CashBookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CashBookController implements the CRUD actions for CashBook model.
 */
class CashBookController extends Controller
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
     * Lists all CashBook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CashBookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CashBook model.
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
     * Creates a new CashBook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
        $model = new CashBook();
        $model->maker_id = Yii::$app->user->identity->username;
        $model->maker_time = date('Y-m-d H:i');
        $model->reference_no = Reference::findLastCashBook();
        $model->zone_id = Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id);
        $model->trn_dt = date('Y-m-d');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            GlDailyBalance::updateGLBalance($model->gl_account,$model->amount,$model->dr_cr);


            TodayEntry::saveEntry(
                $module = 'CB',
                $model->reference_no,
                date('Y-m-d'),
                $model->gl_account,
                Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                $model->amount,
                $ind = $model->dr_cr,
                GeneralLedger::getDescByGLCODE($model->gl_account),
                'CSHB',
                date('Y-m-d'),
                EventType::INIT,
                $model->maker_id
            );
            TodayEntry::updateAll(['auth_stat'=>'A','checker_id'=>$model->maker_id,'checker_time'=>$model->maker_time],['trn_ref_no'=>$model->reference_no,'auth_stat'=>'U']);

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

    public function actionReverse($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);
            if($model->dr_cr == 'C'){
                $model->dr_cr = 'D';
                $model->delete_stat = 'R';
                $model->description = 'Reversed';
            }elseif ($model->dr_cr == 'D'){
                $model->dr_cr = 'C';
                $model->delete_stat = 'R';
                $model->description = 'Reversed';
            }
            GlDailyBalance::updateGLBalance($model->gl_account,$model->amount,$model->dr_cr);

            $reference = $model->reference_no;



            TodayEntry::saveEntry(
                $module = 'CB',
                $reference,
                date('Y-m-d'),
                $model->gl_account,
                Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),
                $model->amount,
                $ind = $model->dr_cr,
                $model->gl_account, 'CSHB',
                date('Y-m-d'),
                EventType::RVS,
                $model->maker_id
            );
            TodayEntry::updateAll(['auth_stat'=>'A','checker_id'=>$model->maker_id,'checker_time'=>$model->maker_time],['trn_ref_no'=>$reference,'auth_stat'=>'U']);


            $model->save();

            return $this->redirect(['cash-book/view','id'=>$id]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CashBook model.
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
     * Deletes an existing CashBook model.
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
     * Finds the CashBook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CashBook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CashBook::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
