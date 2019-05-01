<?php

namespace backend\controllers;

use backend\models\ProductEventEntry;
use Yii;
use backend\models\ProductAccrole;
use backend\models\ProductAccroleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\grid\EditableColumnAction;
use yii\helpers\ArrayHelper;
/**
 * ProductAccroleController implements the CRUD actions for ProductAccrole model.
 */
class ProductAccroleController extends Controller
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
     * Lists all ProductAccrole models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductAccroleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single ProductAccrole model.
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
     * Creates a new ProductAccrole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductAccrole();
        $model->load(Yii::$app->request->post());
            if($model->getRoles($model->product_code,$model->account_role))
            {
                Yii::$app->session->setFlash('danger', 'This Accounting role exists for this product');
                return $this->redirect(['product/view', 'id' => $model->product_code]);

            }
            else
            {

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['product/view', 'id' => $model->product_code]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
        
    }

    /**
     * Updates an existing ProductAccrole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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

    //fetches accounting role
    public function actionFetchRole($id)
    {
        $role_code = ProductAccrole::getAccountRoleCodeByProductCode($id);
        if($role_code!=null){
            return $role_code;
        }
        else{
            return '';
        }
    }

    /**
     * Deletes an existing ProductAccrole model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductAccrole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductAccrole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductAccrole::findOne($id)) !== null) {
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
                'modelClass' => ProductAccrole::className(),             // the update model class
                'outputValue' => function ($model, $attribute, $key, $index) {
                    //$fmt = Yii::$app->formatter;
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'account_head') // selective validation by attribute
                    {
                        ProductEventEntry::updateAll(['mis_head'=>$value],['account_role_code'=>$model->account_role]);
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
