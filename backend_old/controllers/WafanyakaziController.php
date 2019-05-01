<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\User;
use common\models\LoginForm;
use Yii;
use backend\models\Wafanyakazi;
use backend\models\WafanyakaziSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WafanyakaziController implements the CRUD actions for Wafanyakazi model.
 */
class WafanyakaziController extends Controller
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
     * Lists all Wafanyakazi models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new WafanyakaziSearch();
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
     * Displays a single Wafanyakazi model.
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
     * Creates a new Wafanyakazi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new Wafanyakazi();
            $user = new User();


            if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post()) ) {

                if($model->save()){
                    //$user->emp_id=$model->id;
                    $user->user_id = $model->id;
                    try {
                        $user->save();
                        Yii::$app->authManager->assign(Yii::$app->authManager->getRole($user->role), $user->id);
                        Audit::setActivity('New user has been created ' . '(' . $model->jina_kamili . ')', 'Wafanyakazi', 'Create', '', '');

                        Yii::$app->session->setFlash('', [
                            'type' => 'warning',
                            'duration' => 1500,
                            'icon' => 'fa fa-check',
                            'message' => 'Usajili umekamilika',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(['view', 'id' => $model->id]);
                    } catch (Exception $exception) {
                        Yii::$app->session->setFlash('', [
                            'type' => 'danger',
                            'duration' => 1500,
                            'icon' => 'fa fa-warning',
                            'message' => 'Usajili haujakamilika' . $exception,
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        Audit::setActivity('Duplicates user ID in User table ' . '(' . $model->id . ')', 'Wafanyakazi', 'Create', '', '');
                       Wafanyakazi::deleteAll(['id' => $model->id]);
                        return $this->render('create', [
                            'model' => $model,'user'=>$user
                        ]);
                    }

                   }
                }else {
                return $this->render('create', [
                    'model' => $model,'user'=>$user
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
     * Updates an existing Wafanyakazi model.
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
     * Deletes an existing Wafanyakazi model.
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
     * Finds the Wafanyakazi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wafanyakazi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wafanyakazi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
