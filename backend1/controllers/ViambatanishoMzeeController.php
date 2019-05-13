<?php

namespace backend\controllers;

use Yii;
use backend\models\ViambatanishoMzee;
use backend\models\ViambatanishoMzeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ViambatanishoMzeeController implements the CRUD actions for ViambatanishoMzee model.
 */
class ViambatanishoMzeeController extends Controller
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
     * Lists all ViambatanishoMzee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ViambatanishoMzeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ViambatanishoMzee model.
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
     * Creates a new ViambatanishoMzee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ViambatanishoMzee();

        if ($model->load(Yii::$app->request->post())) {
            $model->kiambatanisho = UploadedFile::getInstance($model, 'mzee_kiambatanisho');
            if($model->kiambatanisho !=null) {
                $model->kiambatanisho->saveAs('uploads/viambatanisho/' . $model->kiambatanisho . '.' . $model->kiambatanisho->extension);
                $model->kiambatanisho = $model->kiambatanisho . '.' . $model->kiambatanisho->extension;
                $model->save();
                return $this->redirect(['mzee/view', 'id' => $model->mzee_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ViambatanishoMzee model.
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
     * Deletes an existing ViambatanishoMzee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['mzee/view', 'id' => $model->mzee_id]);
    }

    /**
     * Finds the ViambatanishoMzee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ViambatanishoMzee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ViambatanishoMzee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
