<?php

namespace backend\controllers;

use backend\models\Audit;
use Yii;
use backend\models\ZupsProduct;
use backend\models\ZupsProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ZupsProductController implements the CRUD actions for ZupsProduct model.
 */
class ZupsProductController extends Controller
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
     * Lists all ZupsProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ZupsProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ZupsProduct model.
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
     * Creates a new ZupsProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ZupsProduct();
        $model->aliyeweka = Yii::$app->user->identity->username;
        $model->muda = date('Y-m-d H:i');
        $model->status = ZupsProduct::ACTIVE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Audit::setActivity('New Product has been created ' . '(' . $model->product_code . ')', 'Product', 'Create', '', '');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ZupsProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $beforesave = $model->attributes;
        $model->muda = date('Y-m-d H:i');
        $model->aliyeweka = Yii::$app->user->identity->username;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $aftersave = $model->attributes;
            Audit::setActivity('New Product has been updated ' . '(' . $model->product_code . ')', 'Product', 'Update', $beforesave, $aftersave);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ZupsProduct model.
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
     * Finds the ZupsProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ZupsProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ZupsProduct::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
