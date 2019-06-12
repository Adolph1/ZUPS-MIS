<?php

namespace backend\controllers;

use backend\models\Budget;
use kartik\grid\EditableColumnAction;
use Yii;
use backend\models\GharamaMahitaji;
use backend\models\GharamaMahitajiSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GharamaMahitajiController implements the CRUD actions for GharamaMahitaji model.
 */
class GharamaMahitajiController extends Controller
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
     * Lists all GharamaMahitaji models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GharamaMahitajiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GharamaMahitaji model.
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
     * Creates a new GharamaMahitaji model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GharamaMahitaji();
        if(Yii::$app->user->can('createBudget')) {
        if ($model->load(Yii::$app->request->post())) {
            $siku = $_POST['GharamaMahitaji']['idadi_ya_siku'];
            $idadi = $_POST['GharamaMahitaji']['idadi_ya_vitu'];
            $gharama = $_POST['GharamaMahitaji']['gharama'];
            $model->total = $siku*$idadi*$gharama;
            $exist = GharamaMahitaji::findOne(['budget_id' => $_POST['GharamaMahitaji']['budget_id'],'hitaji_id' => $_POST['GharamaMahitaji']['hitaji_id']]);
            if($exist != null){
                GharamaMahitaji::deleteAll(['id' => $exist->id]);
            }

            $model->save();
            return $this->redirect(['budget/view', 'id' => $model->budget_id]);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        } else {
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 1500,
                'icon' => 'fa fa-warning',
                'message' => 'Hauna uwezo wa kuingiza mahitaji katika budget',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['budget/index']);
        }
    }

    /**
     * Updates an existing GharamaMahitaji model.
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
     * Deletes an existing GharamaMahitaji model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['budget/view','id' => $model->budget_id]);
    }


    public function actionGetBalance($id)
    {
        $mahitaji = GharamaMahitaji::find()->where(['hitaji_id' => $id,'budget_id' => Budget::getCurrent()])->all();
        if($mahitaji != null) {
            $sum = 0.00;
            foreach ($mahitaji as $hitaji){
                $sum = $sum + $hitaji->idadi_ya_siku*$hitaji->idadi_ya_vitu;
            }
            return $sum;

        }else{
            return 0.00;
        }
    }

    public function actionGetMafuta($id)
    {
        if (!Yii::$app->user->isGuest) {
                    $counts = GharamaMahitaji::find()
                        ->where(['wilaya_id' => $id,'budget_id' => Budget::getCurrent()])->count();


                    $mahitaji = GharamaMahitaji::find()
                        ->where(['wilaya_id' => $id,'budget_id' => Budget::getCurrent()])->all();

                    if ($counts > 0) {
                        echo "<option>--Chagua-- </option>";
                        foreach ($mahitaji as $hitaji) {
                            echo "<option value='" . $hitaji->hitaji_id . "'>" . $hitaji->hitaji->hitaji . "</option>";
                        }
                    } else {
                        echo "<option value='--Select--'>--Chagua-- </option>";
                    }

                }




    }

    public function actionGetMafutaBalance($id,$wid)
    {
        $hitaji = GharamaMahitaji::find()->where(['hitaji_id' => $id,'wilaya_id'=>$wid,'budget_id' => Budget::getCurrent()])->one();
        if($hitaji != null) {
            return $hitaji->idadi_ya_vitu * $hitaji->idadi_ya_siku;
        }else{
            return 0.00;
        }
    }

    public function actionGetBei($id)
    {
        $hitaji = GharamaMahitaji::find()->where(['hitaji_id' => $id,'budget_id' => Budget::getCurrent()])->one();
        if($hitaji != null) {
            return $hitaji->gharama;
        }else{
            return 0.00;
        }
    }


    /**
     * Finds the GharamaMahitaji model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GharamaMahitaji the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GharamaMahitaji::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModel1($id)
    {
        if (($model = Budget::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'editcart' => [                                       // identifier for your editable action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => GharamaMahitaji::className(),             // the update model class
                'outputValue' => function ($model, $attribute, $key, $index) {
                    $fmt = Yii::$app->formatter;
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'idadi_ya_siku') // selective validation by attribute
                    {
                        $updateTotal=$this->findModel($model->id);
                        $updateTotal->total=$updateTotal->idadi_ya_siku*$updateTotal->idadi_ya_vitu*$updateTotal->gharama;
                        $updateTotal->save();
                       // Application::updateAll(['app_tab'=>Application::CHARGES],['id'=>$updateTotal->app_id]);
                        // $this->redirect(['application/create']);
                        return $fmt->asDecimal($value, 2);       // return formatted value if desired


                    } elseif ($attribute === 'idadi_ya_vitu') {   // selective validation by attribute

                        $updateTotal=$this->findModel($model->id);
                        $updateTotal->total=$updateTotal->idadi_ya_siku*$updateTotal->idadi_ya_vitu*$updateTotal->gharama;
                        $updateTotal->save();
                        // Application::updateAll(['app_tab'=>Application::CHARGES],['id'=>$updateTotal->app_id]);
                        // $this->redirect(['application/create']);
                        return $fmt->asDecimal($value, 2);       // return formatted value if desired





                    }elseif ($attribute === 'gharama') {   // selective validation by attribute

                        $updateTotal=$this->findModel($model->id);
                        $updateTotal->total=$updateTotal->idadi_ya_siku*$updateTotal->idadi_ya_vitu*$updateTotal->gharama;
                        $updateTotal->save();

                        return $fmt->asDecimal($value, 2);       // return formatted value if desired





                    }
                    return '';                                   // empty is same as $value
                },
                'outputMessage' => function($model, $attribute, $key, $index) {
                    return '';                                  // any custom error after model save
                },
                // 'showModelErrors' => true,                     // show model errors after save
                // 'errorOptions' => ['header' => '']             // error summary HTML options
                // 'postOnly' => true,
                // 'ajaxOnly' => true,
                // 'findModel' => function($id, $action) {},
                // 'checkAccess' => function($action, $model) {}
            ]
        ]);

    }
}
