<?php

namespace backend\controllers;

use backend\models\Audit;
use common\models\LoginForm;
use Yii;
use backend\models\ClerkKituo;
use backend\models\ClerkKituoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClerkKituoController implements the CRUD actions for ClerkKituo model.
 */
class ClerkKituoController extends Controller
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
     * Lists all ClerkKituo models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new ClerkKituoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            Audit::setActivity('Ameangalia orodha ya ratiba ya ma-clerk','ClerkKituo','Index','','');
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

    /**
     * Displays a single ClerkKituo model.
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
     * Creates a new ClerkKituo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
        $model = new ClerkKituo();
        $model->maker_id = Yii::$app->user->identity->username;
        $model->maker_time = date('Y-m-d H:i:s');


        if ($model->load(Yii::$app->request->post())) {
            $date = $_POST['ClerkKituo']['date_assigned'];
            $user_id =  $_POST['ClerkKituo']['user_id'];
            $kituo_id =  $_POST['ClerkKituo']['kituo_id'];

            $ratiba = ClerkKituo::findOne(['kituo_id' => $kituo_id,'user_id' => $user_id,'date_assigned' => $date]);
            if($ratiba != null){
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 3000,
                    'icon' => 'fa fa-warning',
                    'message' => 'Clerk huyu ameshapangiwa kituo hiki siku ya leo',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->render('create', [
                    'model' => $model,
                ]);
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'success',
                    'duration' => 1500,
                    'icon' => 'fa fa-check',
                    'message' => 'Umefanikiwa kumratibisha clerk',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }

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
     * Updates an existing ClerkKituo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing ClerkKituo model.
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
     * Finds the ClerkKituo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClerkKituo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClerkKituo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
