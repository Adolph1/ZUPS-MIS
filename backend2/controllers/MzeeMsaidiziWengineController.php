<?php

namespace backend\controllers;

use backend\models\AutomationSettings;
use backend\models\MsaidiziMzee;
use backend\models\Mzee;
use backend\models\Wafanyakazi;
use Yii;
use backend\models\MzeeMsaidiziWengine;
use backend\models\MzeeMsaidiziWengineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MzeeMsaidiziWengineController implements the CRUD actions for MzeeMsaidiziWengine model.
 */
class MzeeMsaidiziWengineController extends Controller
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
     * Lists all MzeeMsaidiziWengine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MzeeMsaidiziWengineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MzeeMsaidiziWengine model.
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
     * Creates a new MzeeMsaidiziWengine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MzeeMsaidiziWengine();

        if ($model->load(Yii::$app->request->post())) {
            $wazeeWengine = MzeeMsaidiziWengine::find()->where(['mzee_id' => $_POST['MzeeMsaidiziWengine']['mzee_id'],'status' => 1])->all();
            if(count($wazeeWengine)< AutomationSettings::getNextKins(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id))) {
                if (UploadedFile::getInstance($model, 'my_power') != null) {
                    $model->power_of_attorney = UploadedFile::getInstance($model, 'my_power');
                    $model->power_of_attorney->saveAs('uploads/power/' . $model->power_of_attorney . '.' . $model->power_of_attorney->extension);
                    $model->power_of_attorney = $model->power_of_attorney . '.' . $model->power_of_attorney->extension;
                    $model->added_by = Yii::$app->user->identity->username;
                    $model->date_added = date('Y-m-d');
                    $model->status = 1;
                    $model->save();
                } else {
                    $model->added_by = Yii::$app->user->identity->username;
                    $model->date_added = date('Y-m-d');
                    $model->status = 1;
                    $model->save();
                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 5000,
                        'icon' => 'fa fa-check',
                        'message' => 'Umefanikiwa kumpa uwezo wa kuchukulia mzee',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->redirect(['mzee/view', 'id' => $_POST['MzeeMsaidiziWengine']['mzee_id']]);
                }

                $mzee = Mzee::findOne($model->mzee_id);
                if ($mzee != null) {

                    if (Mzee::updateAll(['msaidizi_id' => $model->mzee_id, 'aina_ya_msaidizi' => MsaidiziMzee::MZEE], ['id' => $model->mzee_mwingine_id])) {

                        Yii::$app->session->setFlash('', [
                            'type' => 'success',
                            'duration' => 5000,
                            'icon' => 'fa fa-check',
                            'message' => 'Umefanikiwa kumpa uwezo wa kuchukulia mzee',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(['mzee/view', 'id' => $model->mzee_id]);
                    } else {
                        Yii::$app->session->setFlash('', [
                            'type' => 'danger',
                            'duration' => 500,
                            'icon' => 'fa fa-warning',
                            'message' => 'Imeshindikana',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(['mzee/view', 'id' => $model->mzee_id]);
                    }
                } else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'danger',
                        'duration' => 500,
                        'icon' => 'fa fa-warning',
                        'message' => 'Imeshindikana',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->redirect(['mzee/view', 'id' => $model->mzee_id]);
                }
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                    'duration' => 5000,
                    'icon' => 'fa fa-warning',
                    'message' => 'Mzee ameshafikisha kikomo cha kuwachukuliwa wazee wengine',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['mzee/view', 'id' => $_POST['MzeeMsaidiziWengine']['mzee_id']]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MzeeMsaidiziWengine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MzeeMsaidiziWengine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionDisableMsaidizi($id)
    {

        $mzee = $this->findModel($id);
        Mzee::updateAll(['msaidizi_id' => null],['id'=>$mzee->mzee_id]);
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('', [
            'type' => 'warning',
            'duration' => 5000,
            'icon' => 'fa fa-check',
            'message' => 'Umefanikiwa kumfuta mzee',
            'positonY' => 'top',
            'positonX' => 'right'
        ]);



        return $this->redirect(['mzee/view','id'=>$mzee->mzee_id]);

    }

    /**
     * Finds the MzeeMsaidiziWengine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MzeeMsaidiziWengine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MzeeMsaidiziWengine::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
