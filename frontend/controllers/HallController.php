<?php

namespace frontend\controllers;

use backend\models\Car;
use backend\models\HallAlbum;
use backend\models\Transport;
use Yii;
use backend\models\Hall;
use frontend\models\HallSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HallController implements the CRUD actions for Hall model.
 */
class HallController extends Controller
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
     * Lists all Hall models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HallSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hall model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    //fetches all halls
    public function actionHallList()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $halls = Hall::find()->select("id,name,type,price,people_volume,photo,food_beverage_inclusive,decoration_inclusive,location")->where(['status'=>'A'])->all();

        if(count($halls) > 0 )

        {

            return array('success' => true, 'data'=> $halls);

        }

        else

        {

            return array('success'=>false,'data'=> 'No Hall Found');

        }

    }

    //fetches all hall photos
    public function actionPhotos($id)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;


        $hall_photos = HallAlbum::find()->select("id,photo,hall_id")->where(['hall_id'=>$id])->all();


        if(count($hall_photos) > 0 )

        {

            return array('success' => true, 'data'=> $hall_photos);

        }

        else

        {

            return array('success'=>false,'data'=> 'No Hall Photo Found');

        }

    }

    //fetches all hall photos
    public function actionTransports()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;


        $transports = Transport::find()->select("id,company_name,phone")->where(['status'=>0])->all();


        if(count($transports) > 0 )

        {

            return array('success' => true, 'data'=> $transports);

        }

        else

        {

            return array('success'=>false,'data'=> 'No Transport Found');

        }

    }


//fetches all cars
    public function actionCars()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;


        $transports = Car::find()->select("id,name,car_number,company_id")->where(['status'=>'A'])->all();


        if(count($transports) > 0 )

        {

            return array('success' => true, 'data'=> $transports);

        }

        else

        {

            return array('success'=>false,'data'=> 'No Transport Found');

        }

    }

    /**
     * Creates a new Hall model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hall();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Hall model.
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
     * Deletes an existing Hall model.
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
     * Finds the Hall model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hall the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hall::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
