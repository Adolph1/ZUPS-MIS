<?php

namespace backend\controllers;

use backend\models\Zone;
use common\models\LoginForm;
use Yii;
use backend\models\Mkoa;
use backend\models\MkoaSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MkoaController implements the CRUD actions for Mkoa model.
 */
class MkoaController extends Controller
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
     * Lists all Mkoa models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('viewRegions')) {
            $searchModel = new MkoaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 1500,
                'icon' => 'fa fa-check',
                'message' => 'Hauna uwezo wa kuangalia mikoa',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Displays a single Mkoa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('viewRegions')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 1500,
                'icon' => 'fa fa-check',
                'message' => 'Hauna uwezo wa kuangalia mikoa',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Creates a new Mkoa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('createRegion')) {
            $model = new Mkoa();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
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
                'message' => 'Hauna uwezo wa kuunda mkoa',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing Mkoa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('createRegion')) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        }else{
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 1500,
                'icon' => 'fa fa-check',
                'message' => 'Hauna uwezo wa kuunda mkoa',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing Mkoa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('deleteRegion')) {
            try {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
            } catch (Exception $exception) {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-check',
                    'message' => 'Mkoa huu umetumika,huwezi kuufuta',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['index']);
            }
        }else{
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 1500,
                'icon' => 'fa fa-check',
                'message' => 'Hauna uwezo wa kufuta mkoa',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index']);
        }
    }

    //loads all Mikoa for zone $id
    public function actionLoadAll($id)
    {
        if (!Yii::$app->user->isGuest) {
            $counts = Mkoa::find()
                ->where(['zone_id' => $id])
                ->count();

            $mikoa = Mkoa::find()
                ->where(['zone_id' => $id])
                ->orderBy('jina ASC')
                ->all();

            if ($counts > 0) {
                echo "<option>--Chagua Mkoa-- </option>";
                foreach ($mikoa as $mkoa) {
                    echo "<option value='" . $mkoa->id . "'>" . $mkoa->jina . "</option>";
                }
            } else {
                echo "<option value='--Select--'>--Chagua Mkoa-- </option>";
            }
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }




    /**
     * Finds the Mkoa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mkoa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mkoa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
