<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use backend\models\Shehias;
use backend\models\ShehiasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShehiasController implements the CRUD actions for Shehias model.
 */
class ShehiasController extends Controller
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
     * Lists all Shehias models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new ShehiasSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single Shehias model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Shehias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new Shehias();
            $model->aliyeweka = Yii::$app->user->identity->username;
            $model->muda = date('Y-m-d H:i:s');


            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Shehias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);
            $model->aliyeweka = Yii::$app->user->identity->username;
            $model->muda = date('Y-m-d H:i:s');

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Shehias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Shehias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Shehias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Shehias::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
