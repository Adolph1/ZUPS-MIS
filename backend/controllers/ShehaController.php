<?php

namespace backend\controllers;

use backend\models\ShehaMasaidizi;
use common\models\LoginForm;
use Yii;
use backend\models\Sheha;
use backend\models\ShehaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * ShehaController implements the CRUD actions for Sheha model.
 */
class ShehaController extends Controller
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
     * Lists all Sheha models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new ShehaSearch();
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
     * Displays a single Sheha model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
            $msaidizi = new ShehaMasaidizi();
            return $this->render('view', [
                'model' => $this->findModel($id),'msaidizi' => $msaidizi
            ]);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Sheha model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new Sheha();

            if ($model->load(Yii::$app->request->post())) {
                $shehia_id = $_POST['Sheha']['shehia_id'];
                $aina = $_POST['Sheha']['aina'];
                $checkExistnance = Sheha::find()->where(['shehia_id' => $shehia_id,'aina' => $aina])->one();
                if($checkExistnance != null){
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 1500,
                        'icon' => 'fa fa-warning',
                        'message' => 'Shehia hii tayari inae sheha,tafadhar mfute kwanza aliyepo,uingize mpya',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->render('create', [
                        'model' => $model,
                    ]);

                }else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'message' => 'Umefanikiwa kumuingiza sheha',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    $model->save();
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
     * Updates an existing Sheha model.
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
     * Deletes an existing Sheha model.
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

    /**
     * Finds the Sheha model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sheha the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sheha::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //loads all shehas for wilaya $id
    public function actionLoadAll($id)
    {
        $counts = Sheha::find()
            ->where(['wilaya_id' => $id,'status' => Sheha::ACTIVE])
            ->count();

        $shehas = Sheha::find()
            ->where(['wilaya_id' => $id, 'status' => Sheha::ACTIVE])
            ->orderBy('jina_kamili ASC')
            ->all();

        if ($counts > 0) {
            echo "<option>--Chagua Sheha-- </option>";
            foreach ($shehas as $sheha) {
                echo "<option value='" . $sheha->id . "'>" . $sheha->jina_kamili . "</option>";
            }
        } else {
            echo "<option value='--Select--'>--Chagua Sheha-- </option>";
        }

    }



    //loads all shehas for mkoa $id
    public function actionLoadShehas($id)
    {
        if (!Yii::$app->user->isGuest) {
            $counts = Sheha::find()
                ->where(['shehia_id' => $id, 'status' => Sheha::ACTIVE])
                ->count();

            $shehas = Sheha::find()
                ->where(['shehia_id' => $id, 'status' => Sheha::ACTIVE])
                ->orderBy('jina_kamili ASC')
                ->all();

            if ($counts > 0) {
                echo "<option>--Chagua Mchukua taarifa-- </option>";
                foreach ($shehas as $sheha) {
                    echo "<option value='" . $sheha->id . "'>" . $sheha->jina_kamili . "</option>";
                }
            } else {
                echo "<option value='--Select--'>--Chagua Mchukua taarifa-- </option>";
            }
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }
}
