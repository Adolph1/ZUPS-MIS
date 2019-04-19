<?php

namespace backend\controllers;

use backend\models\MzeeMagonjwa;
use backend\models\MzeeUlemavu;
use backend\models\MzeeVipato;
use DateTime;
use Yii;
use backend\models\Mzee;
use backend\models\MzeeSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MzeeController implements the CRUD actions for Mzee model.
 */
class MzeeController extends Controller
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
     * Lists all Mzee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MzeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mzee model.
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
     * Creates a new Mzee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mzee();


            if ($model->load(Yii::$app->request->post())) {

                $model->picha = UploadedFile::getInstance($model, 'picha');
                $model->picha_mtu_karibu = UploadedFile::getInstance($model, 'picha_mtu_karibu');
                if ($model->picha != null && $model->picha_mtu_karibu) {
                    //$model->picha = UploadedFile::getInstance($model, 'procedure_doc');
                    $model->picha->saveAs('uploads/wazee/' . $model->picha . '.' . $model->picha->extension);
                    $model->picha_mtu_karibu->saveAs('uploads/wasaidizi/' . $model->picha_mtu_karibu . '.' . $model->picha_mtu_karibu->extension);
                    //$model->picha = $customerid . '.' . $procedure->attachment->extension;
                    if ($_POST['Mzee']['mzawa_zanzibar'] == 'Y' && $_POST['Mzee']['tarehe_kuingia_zanzibar'] == " ") {
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    } else {
                        $model->save();
                        $array = $model->magonjwa;
                        $array1 = $model->ulemavu;
                        $array2 = $model->vipato;
                        foreach ($array as $ugonjwa) {
                            $ug = new MzeeMagonjwa();
                            $ug->mzee_id = $model->id;
                            $ug->ugonjwa_id = $ugonjwa;
                            $ug->save();
                        }

                        foreach ($array1 as $ulemavu) {
                            $ug = new MzeeUlemavu();
                            $ug->mzee_id = $model->id;
                            $ug->ulemavu_id = $ulemavu;
                            $ug->save();
                        }

                        foreach ($array2 as $kipato) {
                            $ug = new MzeeVipato();
                            $ug->mzee_id = $model->id;
                            $ug->kipato_id = $kipato;
                            $ug->save();
                        }
                        Yii::$app->session->setFlash('', [
                            'type' => 'warning',
                            'duration' => 1500,
                            'icon' => 'fa fa-check',
                            'message' => 'Usajili umekamilika',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(['index']);
                    }
                } else {
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-check',
                    'message' => 'ingiza picha tafadhar',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

    }

    /**
     * Updates an existing Mzee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            MzeeMagonjwa::deleteAll(['mzee_id' => $id]);
            MzeeUlemavu::deleteAll(['mzee_id' => $id]);
            MzeeVipato::deleteAll(['mzee_id' => $id]);
            $array=$model->magonjwa;
            $array1 = $model->ulemavu;
            $array2 = $model->vipato;
            if($array != null) {
                foreach ($array as $ugonjwa) {
                    $ug = new MzeeMagonjwa();
                    $ug->mzee_id = $model->id;
                    $ug->ugonjwa_id = $ugonjwa;
                    $ug->save();
                }
            }
            if($array1 != null) {
                foreach ($array1 as $ulemavu) {
                    $ug = new MzeeUlemavu();
                    $ug->mzee_id = $model->id;
                    $ug->ulemavu_id = $ulemavu;
                    $ug->save();
                }
            }
            if($array2 != null) {
                foreach ($array2 as $kipato) {
                    $ug = new MzeeVipato();
                    $ug->mzee_id = $model->id;
                    $ug->kipato_id = $kipato;
                    $ug->save();
                }
            }
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 1500,
                'icon' => 'fa fa-check',
                'message' => 'Usajili umekamilika',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index']);
        } else {
            $model->magonjwa = ArrayHelper::map($model->mzeeMagonjwa, 'id', 'ugonjwa_id');
            $model->vipato = ArrayHelper::map($model->mzeeVipato, 'id', 'kipato_id');
            $model->ulemavu = ArrayHelper::map($model->mzeeUlemavu, 'id', 'ulemavu_id');
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mzee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetYears($id)
    {
        $date = date('Y-m-d H:i:s',strtotime($id));
        $date_1 = new DateTime($date);
        $date_2 = new DateTime( date( 'Y-m-d H:i:s' ) );

        $difference = $date_2->diff($date_1);

// Echo the as string to display in browser for testing
        return $difference->y;
       // return array ( 'years' => $diff->y, 'months' => $diff->m );
    }

    /**
     * Finds the Mzee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mzee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mzee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
