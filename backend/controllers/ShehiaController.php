<?php

namespace backend\controllers;

use backend\models\KituoShehia;
use backend\models\Sheha;
use common\models\LoginForm;
use Yii;
use backend\models\Shehia;
use backend\models\ShehiaSearch;
use yii\db\Exception;
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
            if(Yii::$app->user->can('viewWards')) {
                $searchModel = new ShehiaSearch();
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
                    'message' => 'Hauna uwezo wa kuangalia shehia',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['site/index']);
            }
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
            if(Yii::$app->user->can('viewWards')) {
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-check',
                    'message' => 'Hauna uwezo wa kuangalia shehia',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['site/index']);
            }
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
            if(Yii::$app->user->can('createWard')) {
                $model = new Shehia();
                $model->aliyeweka = Yii::$app->user->identity->username;
                $model->muda = date('Y-m-d H:i:s');

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
                    'message' => 'Hauna uwezo wa kuingiza shehia mpya',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['index']);
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
            if(Yii::$app->user->can('createWard')) {
            $model = $this->findModel($id);
            $model->aliyeweka = Yii::$app->user->identity->username;
            $model->muda = date('Y-m-d H:i:s');
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
                    'message' => 'Hauna uwezo wa kubadili taarifa za shehia',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['index']);
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
            if(Yii::$app->user->can('deleteDistrict')) {
                try {
                    $this->findModel($id)->delete();


                    return $this->redirect(['index']);
                } catch (Exception $exception) {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'message' => 'Wilaya hii imetumika,huwezi kuufuta',
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
                    'message' => 'Hauna uwezo wa kufuta shehia',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['index']);
            }
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
