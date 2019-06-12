<?php
namespace backend\controllers;

use backend\models\Audit;
use backend\models\Complains;
use backend\models\Mzee;
use backend\models\User;
use backend\models\Wafanyakazi;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new Mzee();
            if (Yii::$app->user->can('DataClerk') || Yii::$app->user->can('Cashier')) {
                return $this->render('normal_index', ['model' => $model]);
            } elseif (Yii::$app->user->can('PensionOfficer') || Yii::$app->user->can('HQ-PensionOfficer') || Yii::$app->user->can('admin')) {
                return $this->render('index', ['model' => $model]);
            } elseif (Yii::$app->user->can('Accountant')) {
                return $this->render('accountant', ['model' => $model]);
            } elseif (Yii::$app->user->can('reviewBudget') || Yii::$app->user->can('approveBudget') || Yii::$app->user->can('secondBudgetApprove')) {
                return $this->render('normal_index', ['model' => $model]);
            }
        }else{
            $model = new LoginForm();
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        else{
            return $this->render('default');
        }
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        $model = new LoginForm();
        $complaints = new Complains();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            Audit::setActivity('New Login at '.date('Y-m-d H:i:s'),'ULG','login','','');
            Yii::$app->session->setFlash('', [
                'type' => 'success',
                'duration' => 6000,
                'icon' => 'fa fa-check',
                'message' => Wafanyakazi::getFullnameByUserId(Yii::$app->user->identity->user_id). ', Mwisho kuingia kwenye mfumo:'. Yii::$app->user->identity->last_login,
                'positonY' => 'top',
                'positonX' => 'center'
            ]);
            User::updateAll(['last_login' => date('Y-m-d H:i:s'),'login_session' => 1],['username' => Yii::$app->user->identity->username]);
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,'complaints' => $complaints
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {

        User::updateAll(['login_session' => 0],['username' => Yii::$app->user->identity->username]);
        Audit::setActivity(Yii::$app->user->identity->username. ' logout at ' .date('Y-m-d H:i:s'),'ULG','Logout','','');
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
