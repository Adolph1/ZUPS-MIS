<?php

namespace backend\controllers;

use backend\models\Audit;
use common\models\LoginForm;
use Yii;
use backend\models\AutomationSettings;
use backend\models\AutomationSettingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AutomationSettingsController implements the CRUD actions for AutomationSettings model.
 */
class AutomationSettingsController extends Controller
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
     * Lists all AutomationSettings models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new AutomationSettingsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            Audit::setActivity('ameangalia orodha ya automation settings', 'AutomationSettings', 'Index', '', '');
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
     * Displays a single AutomationSettings model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
        $model = $this->findModel($id);
        Audit::setActivity('ameangalia automation settings'.$model->zone->jina, 'AutomationSettings', 'View', '', '');
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
     * Creates a new AutomationSettings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
        $model = new AutomationSettings();
        $model->aliyeweka = Yii::$app->user->identity->username;
        $model->muda = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post())) {
            $zone_id = $_POST['AutomationSettings']['zone_id'];
            $checkisextance = AutomationSettings::findOne(['zone_id' => $zone_id]);
            if($checkisextance != null){
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => 'Automation settings kwa zone hii zipo tayari',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->render('create', [
                    'model' => $model,
                ]);
            }else{
                $model->save();
                Yii::$app->session->setFlash('', [
                    'type' => 'success',
                    'duration' => 1500,
                    'icon' => 'fa fa-check',
                    'message' => 'Umefanikiwa kuingiza Automation settings',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                Audit::setActivity('ameangalia kuunda automation settings'.$model->zone->jina, 'AutomationSettings', 'Create', '', '');
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
     * Updates an existing AutomationSettings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
        $model = $this->findModel($id);
        $beforesave = $model->attributes;
        $model->aliyeweka = Yii::$app->user->identity->username;
        $model->muda = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $aftersave = $model->attributes;
            Audit::setActivity('amefanya marekebisho ya automation settings' . '(' . $model->zone->jina . ')', 'AutomationSettings', 'Update', $beforesave, $aftersave);
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
     * Deletes an existing AutomationSettings model.
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
     * Finds the AutomationSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AutomationSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AutomationSettings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
