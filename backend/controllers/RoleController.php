<?php
/**
 * Created by JetBrains PhpStorm.
 * User: funson
 * Date: 14-9-9
 * Time: 下午4:54
 * To change this template use File | Settings | File Templates.
 */
namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\HttpException;

use backend\models\Auth;
use backend\models\AuthSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;

class RoleController extends Controller
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

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new AuthSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->get(), Auth::TYPE_ROLE);
            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            if (yii::$app->User->can('admin')) {
                $model = new Auth();
                if ($model->load(Yii::$app->request->post())) {
                    $permissions = $this->preparePermissions(Yii::$app->request->post());
                    if ($model->createRole($permissions)) {

                        Yii::$app->session->setFlash('', [
                            'type' => 'success',
                            'duration' => 1500,
                            'icon' => 'fa fa-check',
                            'message' => Yii::t('app', 'Umefanikiwa kuingiza role'),
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);

                        return $this->redirect(['view', 'name' => $model->name]);
                    } else {
                        $permissions = $this->getPermissions();
                        $model->_permissions = Yii::$app->request->post()['Auth']['_permissions'];
                        return $this->render('create', [
                                'model' => $model,
                                'permissions' => $permissions
                            ]
                        );
                    }
                } else {
                    $permissions = $this->getPermissions();
                    return $this->render('create', [
                            'model' => $model,
                            'permissions' => $permissions
                        ]
                    );
                }
            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => Yii::t('app', 'Hauna uwezo wa kuingiza role'),
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

    public function actionUpdate($name)
    {
        if (!Yii::$app->user->isGuest) {
            if (yii::$app->User->can('admin')) {
                if ($name == 'admin') {
                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'message' => Yii::t('app', 'Umefanikiwa kurekebisha role'),
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['view', 'name' => $name]);
                }
                $model = $this->findModel($name);
                if ($model->load(Yii::$app->request->post())) {
                    $permissions = $this->preparePermissions(Yii::$app->request->post());
                    if ($model->updateRole($name, $permissions)) {
                        Yii::$app->session->setFlash('', [
                            'type' => 'success',
                            'duration' => 1500,
                            'icon' => 'fa fa-check',
                            'message' => Yii::t('app', 'Umefanikiwa kurekebisha role'),
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(['view', 'name' => $name]);
                    }
                } else {
                    $permissions = $this->getPermissions();
                    $model->loadRolePermissions($name);
                    return $this->render('update', [
                            'model' => $model,
                            'permissions' => $permissions,
                        ]
                    );
                }
            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => Yii::t('app', 'Hauna uwezo wa kuingiza role'),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['index']);
            }
        } else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($name)
    {
        if (!Yii::$app->user->isGuest) {
            if (yii::$app->User->can('admin')) {
                if (!Yii::$app->user->can('deleteRole')) throw new HttpException(500, 'No Auth');

                if ($name) {
                    if (!Auth::hasUsersByRole($name)) {
                        $auth = Yii::$app->getAuthManager();
                        $role = $auth->getRole($name);

                        // clear asset permissions
                        $permissions = $auth->getPermissionsByRole($name);
                        foreach ($permissions as $permission) {
                            $auth->removeChild($role, $permission);
                        }
                        if ($auth->remove($role)) {
                            Yii::$app->session->setFlash('success', " '$name' " . Yii::t('app', 'successfully removed'));
                        }
                    } else {
                        Yii::$app->session->setFlash('warning', " '$name' " . Yii::t('app', 'still used'));
                    }
                }
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('app', 'You dont have permission to delete a role'));
                return $this->redirect(['index']);
            }
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionView($name)
    {
        if (!Yii::$app->user->isGuest) {
            $model = $this->findModel($name);
            $model->loadRolePermissions($name);
            $permissions = $this->getPermissions();
            return $this->render('view', [
                'model' => $model,
                'permissions' => $permissions,
            ]);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    protected function findModel($name)
    {
        if ($name) {
            $auth = Yii::$app->getAuthManager();
            $model = new Auth();
            $role = $auth->getRole($name);
            if ($role) {
                $model->name = $role->name;
                $model->description = $role->description;
                $model->setIsNewRecord(false);
                return $model;
            }
        }
        throw new HttpException(404);
    }

    protected function getPermissions() {
        $models = Auth::find()->where(['type' => Auth::TYPE_PERMISSION])->all();
        $permissions = [];
        foreach($models as $model) {
            $permissions[$model->name] = $model->name . ' (' . $model->description . ')';
        }
        return $permissions;
    }

    protected function preparePermissions($post) {
        return (isset($post['Auth']['_permissions']) &&
            is_array($post['Auth']['_permissions'])) ? $post['Auth']['_permissions'] : [];
    }
}
