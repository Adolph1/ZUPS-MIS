<?php

namespace backend\controllers;

use backend\models\Wafanyakazi;
use common\models\LoginForm;
use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $arrayStatus = User::getArrayStatus();
            $arrayRole = User::getArrayRole();

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'arrayStatus' => $arrayStatus,
                'arrayRole' => $arrayRole,
            ]);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            if (yii::$app->User->can('createUser')) {
                $model = new User();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $model->id);

                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            } else {

                Yii::$app->session->setFlash('danger', 'You dont have permition to create user.');
                return $this->redirect(['index']);
            }
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);
            $model->setScenario('admin-update');
            if (yii::$app->User->can('createUser')) {

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    Yii::$app->authManager->revokeAll($id);
                    Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $id);
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            } else {
                Yii::$app->session->setFlash('danger', 'You dont have permition to update user.');
                return $this->redirect(['index']);
            }
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
        if (yii::$app->User->can('createUser')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('danger', 'You dont have permition to delete user');
            return $this->redirect(['index']);
        }
        }else{
        $model = new LoginForm();
        return $this->redirect(['site/login',
            'model' => $model,
        ]);
    }
    }


    public function actionProfile($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);
            $emp=$this->findEmpModel($model->user_id);
            $model->setScenario('admin-update');
            if($model->load(Yii::$app->request->post())) {
                Yii::$app->authManager->revokeAll($id);
                Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $id);
                $model->save();
                Yii::$app->session->setFlash('success', 'You have successfully changed your password.');
                return $this->redirect(['profile', 'id' => $model->id]);
            }else {
                return $this->render('profile', [
                    'model' => $this->findModel($id), 'emp' => $emp
                ]);
            }
        }
        else {
            $model = new LoginForm();
            return $this->render('site/login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function findEmpModel($id)
    {
        if (($model = Wafanyakazi::find()->where(['id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
