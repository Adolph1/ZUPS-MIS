<?php

namespace backend\controllers;

use backend\models\Audit;
use common\models\LoginForm;
use Yii;
use backend\models\Wilaya;
use backend\models\WilayaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WilayaController implements the CRUD actions for Wilaya model.
 */
class WilayaController extends Controller
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
     * Lists all Wilaya models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new WilayaSearch();
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
     * Displays a single Wilaya model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);
            Audit::setActivity('View '.$model->jina .' district details','Wilaya','View','','');
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
     * Creates a new Wilaya model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new Wilaya();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Audit::setActivity('created '.$model->jina .' district','Wilaya','Create','','');
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
     * Updates an existing Wilaya model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);
            $beforesave = $model->attributes;

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $aftersave = $model->attributes;
                Audit::setActivity('Updated','Wilaya','Update',$beforesave,$aftersave);
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
     * Deletes an existing Wilaya model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
            $this->findModel($id)->delete();
            Audit::setActivity('deleted','Wilaya','Delete','','');

            return $this->redirect(['index']);
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    //loads all shehas for mkoa $id
    public function actionLoadAll($id)
    {
        if (!Yii::$app->user->isGuest) {
            $counts = Wilaya::find()
                ->where(['mkoa_id' => $id])
                ->count();

            $wilayas = Wilaya::find()
                ->where(['mkoa_id' => $id])
                ->orderBy('jina ASC')
                ->all();

            if ($counts > 0) {
                echo "<option>--Chagua Wilaya-- </option>";
                foreach ($wilayas as $wilaya) {
                    echo "<option value='" . $wilaya->id . "'>" . $wilaya->jina . "</option>";
                }
            } else {
                echo "<option value='--Select--'>--Chagua Wilaya-- </option>";
            }
        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Finds the Wilaya model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wilaya the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wilaya::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
