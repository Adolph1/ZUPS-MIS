<?php

namespace backend\controllers;

use backend\models\ProductAccrole;
use Yii;
use backend\models\ProductEventEntry;
use backend\models\ProductEventEntrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\grid\EditableColumnAction;
use yii\helpers\ArrayHelper;

/**
 * ProductEventEntryController implements the CRUD actions for ProductEventEntry model.
 */
class ProductEventEntryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductEventEntry models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductEventEntrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductEventEntry model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductEventEntry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductEventEntry();


        if ($model->load(Yii::$app->request->post())) {
            $model->mis_head=ProductAccrole::getGLByAccountRole($_POST['ProductEventEntry']['account_role_code']);
            $model->save();
            return $this->redirect(['product/view', 'id' => $model->product_code]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProductEventEntry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->product_code]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductEventEntry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);

        $this->findModel($id)->delete();

        return $this->redirect(['product/view', 'id' => $model->product_code]);
    }

    public function actionOffset($id)
    {
        $offsetacc = ProductEventEntry::find()
            ->where(['product_code' => $id])
            ->one();

        if ($offsetacc!=null) {
            return $offsetacc->mis_head;
        }
        else {
            return "";
        }


    }

    /**
     * Finds the ProductEventEntry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductEventEntry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductEventEntry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'edit-gl' => [                                       // identifier for your editable action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => ProductEventEntry::className(),             // the update model class
                'outputValue' => function ($model, $attribute, $key, $index) {
                    //$fmt = Yii::$app->formatter;
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'mis_head') // selective validation by attribute
                    {
                        return $value;    // return formatted value if desired


                    } elseif ($attribute === 'dr_cr_indicator') {   // selective validation by attribute

                        return $value;    // return formatted value if desired

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
