<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\CashierAccount;
use backend\models\MiamalaWatendaji;
use backend\models\Teller;
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
            $user = User::findOne(['user_id' => $id]);

            $user->setScenario('admin-update');
            if($user->load(Yii::$app->request->post())) {
                Yii::$app->authManager->revokeAll($user->id);
                Yii::$app->authManager->assign(Yii::$app->authManager->getRole($user->role), $user->id);
                $user->save();

                Yii::$app->session->setFlash('', [
                    'type' => 'success',
                    'duration' => 1500,
                    'icon' => 'fa fa-check',
                    'message' => 'Umefanikiwa kubadil neno la siri',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['view', 'id' => $id]);
            }else {
                return $this->render('view', [
                    'model' => $this->findModel($id),'user' => $user
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
     * Creates a new Wafanyakazi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('createUser')) {
                $model = new Wafanyakazi();
                $user = new User();
                $model->aliyeweka = Yii::$app->user->identity->username;
                $model->muda = date('Y-m-d H:i');
                $model->status = Wafanyakazi::ACTIVE;

                if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {

                    if ($model->save()) {

                        $user->user_id = $model->id;
                        try {
                            if ($user->save()) {
                                Yii::$app->authManager->assign(Yii::$app->authManager->getRole($user->role), $user->id);
                                if ($user->role == 'Cashier') {
                                    // print_r('wrong');
                                    $account = new CashierAccount();
                                    $account->cashier_id = $user->user_id;
                                    $account->account = CashierAccount::findLast();
                                    $account->opening_balance = 0.00;
                                    $account->current_balance = 0.00;
                                    $account->maker_id = Yii::$app->user->identity->username;
                                    $account->maker_time = date('Y-m-d H:i');
                                    if (!$account->save()) {
                                        // print_r('wrong');
                                        Yii::$app->session->setFlash('', [
                                            'type' => 'warning',
                                            'duration' => 1500,
                                            'icon' => 'fa fa-check',
                                            'message' => 'account ya cashier haijafunguliwa kikamilifu',
                                            'positonY' => 'top',
                                            'positonX' => 'right'
                                        ]);
                                        Audit::setActivity('account ya cashier haijafunguliwa kikamilifu' . '(' . $model->jina_kamili . ')', 'Wafanyakazi', 'Create', '', '');
                                        return $this->redirect(['view', 'id' => $model->id]);
                                    } else {
                                        Audit::setActivity('account ya cashier imefunguliwa kikamilifu' . '(' . $model->jina_kamili . ')', 'Cashier account', 'Create', '', '');
                                        return $this->redirect(['view', 'id' => $model->id]);
                                    }
                                }

                                Audit::setActivity('New user has been created ' . '(' . $model->jina_kamili . ')', 'Wafanyakazi', 'Create', '', '');

                                return $this->redirect(['view', 'id' => $model->id]);
                            } else {
                                Yii::$app->session->setFlash('', [
                                    'type' => 'danger',
                                    'duration' => 1500,
                                    'icon' => 'fa fa-warning',
                                    'message' => 'Usajili haujakamilika,username imeshatumika',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);
                                Audit::setActivity('Duplicates user ID in User table ' . '(' . $model->id . ')', 'Wafanyakazi', 'Create', '', '');
                                Wafanyakazi::deleteAll(['id' => $model->id]);
                                return $this->render('create', [
                                    'model' => $model, 'user' => $user
                                ]);
                            }
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
                                'model' => $model, 'user' => $user
                            ]);
                        }

                    }
                } else {
                    return $this->render('create', [
                        'model' => $model, 'user' => $user
                    ]);
                }
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => 'Hauna uwezo wa kumuingiza mfanyakazi',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
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
     * Updates an existing Wafanyakazi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('createUser')) {
                $model = $this->findModel($id);
                $model->aliyeweka = Yii::$app->user->identity->username;
                $model->muda = date('Y-m-d H:i');

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => 'Hauna uwezo wa kurekebisha taarifa za mfanyakazi',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
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
     * Deletes an existing Wafanyakazi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('createUser')) {
                $model = $this->findModel($id);
                try {
                    $checkTeller = Teller::findAll(['related_customer' => $id]);
                    $checkWatendaji = MiamalaWatendaji::findAll(['cashier_id' => $id]);
                    if($checkTeller == null && $checkWatendaji == null){
                        CashierAccount::deleteAll(['cashier_id' => $id]);
                    }
                    if ($this->findModel($id)->delete()) {
                        User::deleteAll(['user_id' => $id]);
                        Yii::$app->session->setFlash('', [
                            'type' => 'success',
                            'duration' => 1500,
                            'icon' => 'fa fa-check',
                            'message' => 'umefanikiwa kumfuta mfanyakazi',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        Audit::setActivity('Amemfuta mfanyakazi huyu ' . '(' . $model->jina_kamili . '-' . $id . ')', 'Wafanyakazi', 'Create', '', '');
                        return $this->redirect(['index']);
                    }
                }catch (Exception $exception) {
                    Yii::$app->session->setFlash('', [
                        'type' => 'danger',
                        'duration' => 3000,
                        'icon' => 'fa fa-warning',
                        'message' => 'Huwezi kumfuta mfanyakazi huyu,ameshatumika,unaweza kumsitisha asiingie kwenye mfumo',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    Audit::setActivity('anajaribu kmfuta mfanyakazi huyu' . '(' . $model->id . ')', 'Wafanyakazi', 'Delete', '', '');
                    return $this->redirect(['index']);
                }


            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => 'Hauna uwezo wa kumfuta mfanyakazi',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
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
