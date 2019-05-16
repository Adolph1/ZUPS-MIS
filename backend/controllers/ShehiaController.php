<?php

namespace backend\controllers;

use backend\models\KituoShehia;
use backend\models\Sheha;
use common\models\LoginForm;
use Yii;
use backend\models\Shehia;
use backend\models\ShehiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShehiaController implements the CRUD actions for Shehia model.
 */
class ShehiaController extends Controller
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
     * Lists all Shehia models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new ShehiaSearch();
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
     * Displays a single Shehia model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
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
     * Creates a new Shehia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new Shehia();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing Shehia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
     * Deletes an existing Shehia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
            $this->findModel($id)->delete();


            return $this->redirect(['index']);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }



    //loads all shehas for wilaya $id
    public function actionLoadAll($id)
    {
        if (!Yii::$app->user->isGuest) {
            $counts = Shehia::find()
                ->where(['wilaya_id' => $id])
                ->count();

            $shehias = Shehia::find()
                ->where(['wilaya_id' => $id])
                ->orderBy('jina ASC')
                ->all();

            if ($counts > 0) {
                echo "<option>--Chagua Shehia-- </option>";
                foreach ($shehias as $shehia) {
                    echo "<option value='" . $shehia->id . "'>" . $shehia->jina . "</option>";
                }
            } else {
                echo "<option value='--Select--'>--Chagua Shehia-- </option>";
            }
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    //loads all shehas for wilaya $id for kituo
    public function actionLoadRemained($id)
    {
        if (!Yii::$app->user->isGuest) {
            $kituoShehia = KituoShehia::find()->select('shehia_id');
            $counts = Shehia::find()
                ->where(['wilaya_id' => $id])
                ->andWhere(['not in','id',$kituoShehia])
                ->count();

            $shehias = Shehia::find()
                ->where(['wilaya_id' => $id])
                ->andWhere(['not in','id',$kituoShehia])
                ->orderBy('jina ASC')
                ->all();

            if ($counts > 0) {
                echo "<option>--Chagua Shehia-- </option>";
                foreach ($shehias as $shehia) {
                    echo "<option value='" . $shehia->id . "'>" . $shehia->jina . "</option>";
                }
            } else {
                echo "<option value='--Select--'>--Chagua Shehia-- </option>";
            }
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }


    /**
     * Finds the Shehia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Shehia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Shehia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //load sheha for by shehia $id
    public function actionGetSheha($id)
    {
        $model=$this->findModel($id);
       $sheha = Sheha::findOne($model->sheha_id);

        if ($sheha != null) {
            echo "<option>--Chagua Mchukua taarifa-- </option>";

                echo "<option value='" . $sheha->id . "'>" . $sheha->jina_kamili . "</option>";

        } else {
            echo "<option value='--Select--'>--Chagua Mchukua taarifa-- </option>";
        }

    }
}
