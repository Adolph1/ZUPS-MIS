<?php

namespace backend\controllers;

use backend\models\KituoCashier;
use backend\models\KituoShehia;
use backend\models\Mzee;
use Yii;
use backend\models\Vituo;
use backend\models\VituoSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Exception;

/**
 * VituoController implements the CRUD actions for Vituo model.
 */
class VituoController extends Controller
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
     * Lists all Vituo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VituoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vituo model.
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
     * Creates a new Vituo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vituo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $array = $model->shehias;
            if($array != null) {
                foreach ($array as $shehia) {
                    $sh = new KituoShehia();
                    $sh->kituo_id = $model->id;
                    $sh->shehia_id = $shehia;
                    $sh->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vituo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $shehias = KituoShehia::find()->where(['kituo_id' => $id])->all();
            KituoShehia::deleteAll(['kituo_id' => $id]);
            $array = $model->shehias;
            if($array != null) {
                foreach ($array as $shehia) {
                    $sh = new KituoShehia();
                    $sh->kituo_id = $model->id;
                    $sh->shehia_id = $shehia;
                    try {
                        $sh->save();
                    }catch (Exception $exception) {
                        Yii::$app->session->setFlash('', [
                            'type' => 'warning',
                            'duration' => 3000,
                            'icon' => 'fa fa-warning',
                            'message' => 'Shehia hii, ' .$sh->shehia->jina. ' Imeshaingizwa tayari',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    }
                }
                foreach ($shehias as $shehia){
                    $checkshehia = KituoShehia::find()->where(['shehia_id' => $shehia->shehia_id,'kituo_id' => $id])->one();
                    if($checkshehia != null){
                        //true
                    }else{
                        Mzee::updateAll(['kituo_id' => null],['shehia_id' => $shehia->shehia_id]);
                    }
                }



            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->shehias = ArrayHelper::map($model->kituoShehias, 'id', 'shehia_id');

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vituo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            if($this->findModel($id)->delete()) {
                Yii::$app->session->setFlash('', [
                    'type' => 'success',
                    'duration' => 1500,
                    'icon' => 'fa fa-check',
                    'message' => 'Umefanikiwa kufuta kituo hiki',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                KituoShehia::deleteAll(['kituo_id' => $id]);
                return $this->redirect(['index']);
            }
        }catch (Exception $exception) {
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 1500,
                'icon' => 'fa fa-warning',
                'message' => 'Kituo hiki kinatumika huwezi kufuta',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Vituo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vituo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vituo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
