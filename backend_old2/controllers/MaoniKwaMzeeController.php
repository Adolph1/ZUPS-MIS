<?php

namespace backend\controllers;

use backend\models\Malipo;
use backend\models\Mzee;
use Yii;
use backend\models\MaoniKwaMzee;
use backend\models\MaoniKwaMzeeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MaoniKwaMzeeController implements the CRUD actions for MaoniKwaMzee model.
 */
class MaoniKwaMzeeController extends Controller
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
     * Lists all MaoniKwaMzee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaoniKwaMzeeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MaoniKwaMzee model.
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
     * Creates a new MaoniKwaMzee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MaoniKwaMzee();
        $model->aliyeweka = Yii::$app->user->identity->username;
        $model->muda = date('Y-m-d H:i');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Mzee::updateAll(['status' => Mzee::SUSPENDED],['id' => $model->mzee_id]);
                //suppress all Mzee voucher
                Malipo::updateAll(['status' => Malipo::SUPPRESSED],['status' => Malipo::PENDING,'mzee_id' => $model->mzee_id]);
            return $this->redirect(['mzee/view', 'id' => $model->mzee_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MaoniKwaMzee model.
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
     * Deletes an existing MaoniKwaMzee model.
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
     * Finds the MaoniKwaMzee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MaoniKwaMzee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MaoniKwaMzee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
