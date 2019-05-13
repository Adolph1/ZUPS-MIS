<?php

namespace backend\controllers;

use backend\models\Mzee;
use common\models\LoginForm;
use Yii;
use backend\models\HamishaMzee;
use backend\models\HamishaMzeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HamishaMzeeController implements the CRUD actions for HamishaMzee model.
 */
class HamishaMzeeController extends Controller
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
     * Lists all HamishaMzee models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
        $searchModel = new HamishaMzeeSearch();
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
     * Displays a single HamishaMzee model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
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


    public function actionUnDo($id)
    {
        if (!Yii::$app->user->isGuest) {
        $model = $this->findModel($id);
        if($model != null){
            Mzee::updateAll(['mkoa_id' =>$model->mkoa_aliotoka,'wilaya_id' => $model->wilaya_aliyotoka,'shehia_id' => $model->shehia_aliyotoka,'status'=>$model->status],['id'=> $model->mzee_id]);
           HamishaMzee::deleteAll(['id'=>$id]);
            return $this->redirect(['index']);
        }else{
            return null;
        }
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Creates a new HamishaMzee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
        $model = new HamishaMzee();

        if ($model->load(Yii::$app->request->post())) {
            $mzee = Mzee::findOne(['id' => $_POST['HamishaMzee']['mzee_id']]);
            if($mzee != null){
                $model->mkoa_aliotoka = $mzee->mkoa_id;
                $model->wilaya_aliyotoka = $mzee->wilaya_id;
                $model->shehia_aliyotoka = $mzee->shehia_id;
            }
            $model->aliyeingiza = Yii::$app->user->identity->username;
            $model->muda = date('Y-m-d H:i:s');
            if($model->save()){
                Mzee::updateAll(['mkoa_id' => $model->mkoa_anaokwenda,'wilaya_id' => $model->wilaya_anayokwenda,'shehia_id' =>$model->shehia_anayokwenda,'status' => Mzee::PENDING],['id'=>$model->mzee_id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HamishaMzee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HamishaMzee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
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
     * Finds the HamishaMzee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HamishaMzee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HamishaMzee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
