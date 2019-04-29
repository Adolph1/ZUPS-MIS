<?php

namespace backend\controllers;

use backend\models\BidhaaZilizobaki;
use Yii;
use backend\models\BidhaaZilizotolewa;
use backend\models\BidhaaZilizotolewaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BidhaaZilizotolewaController implements the CRUD actions for BidhaaZilizotolewa model.
 */
class BidhaaZilizotolewaController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all BidhaaZilizotolewa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BidhaaZilizotolewaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BidhaaZilizotolewa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BidhaaZilizotolewa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BidhaaZilizotolewa();

        if ($model->load(Yii::$app->request->post()) ) {

           if($_POST['BidhaaZilizotolewa']['jumla'] >= $_POST['BidhaaZilizotolewa']['idadi']){
               $model->save();
               BidhaaZilizobaki::lessStoke($model->bidhaa_id,$model->idadi);
               Yii::$app->session->setFlash('', [
                   'type' => 'success',
                   'duration' => 4500,
                   'icon' => 'fa fa-check',
                   'message' => 'Umefanikiwa kutoa bidhaa',
                   'positonY' => 'top',
                   'positonX' => 'right'
               ]);
               return $this->redirect(['view', 'id' => $model->id]);
           }else{
               Yii::$app->session->setFlash('', [
                   'type' => 'warning',
                   'duration' => 4500,
                   'icon' => 'fa fa-warning',
                   'message' => 'Idadi unayotaka kutoa haiwezi zidi iliyopo kwenye stock',
                   'positonY' => 'top',
                   'positonX' => 'right'
               ]);
               return $this->render('create', [
                   'model' => $model,
               ]);
           }



        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BidhaaZilizotolewa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BidhaaZilizotolewa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BidhaaZilizotolewa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BidhaaZilizotolewa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BidhaaZilizotolewa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
