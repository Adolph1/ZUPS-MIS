<?php

namespace backend\controllers;

use backend\models\Budget;
use backend\models\Malipo;
use backend\models\Mzee;
use backend\models\Reference;
use backend\models\VituoSearch;
use backend\models\Wafanyakazi;
use backend\models\ZupsProduct;
use common\models\LoginForm;
use kartik\grid\EditableColumnAction;
use kartik\mpdf\Pdf;
use Yii;
use backend\models\Voucher;
use backend\models\VoucherSearch;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VoucherController implements the CRUD actions for Voucher model.
 */
class VoucherController extends Controller
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
     * Lists all Voucher models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
        $searchModel = new VoucherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionKituoVoucher()
    {
        if (!Yii::$app->user->isGuest) {
        $searchModel = new VituoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('kituo_voucher', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single Voucher model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    /**
     * Preview batch of Voucher Items.
     * @param integer $id
     * @return mixed
     */

    /**
     * Preview batch of Voucher Items.
     * @param integer $id
     * @return mixed
     */
    public function actionPrintPreview($id)
    {
        if (!Yii::$app->user->isGuest) {
        $currentBudget = Budget::getCurrentBudget(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id));
        if($currentBudget != null) {
            $vouchers = Voucher::find()->select('id')->where(['mwezi' => $currentBudget->kwa_mwezi,'mwaka' => $currentBudget->kwa_mwaka, 'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $malipo = Malipo::find()->select('voucher_id,shehia_id')->where(['in', 'voucher_id', $vouchers])->andWhere(['kituo_id' => $id])->groupBy('shehia_id')->all();
            //$malipo->asArray()->all();
            if ($malipo != null) {

                // print_r($malipo);
                //exit;
                $pdf = new Pdf([
                    'mode' => Pdf::DEST_DOWNLOAD, // leaner size using standard fonts
                    'content' => $this->renderPartial('print', [
                        'malipo' => $malipo
                    ]),
                    'options' => [
                        'title' => 'Privacy Policy - Krajee.com',
                        'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                    ],
                    'methods' => [
                        'SetHeader' => [' ZUPS - MIS VOUCHER ||Generated On: ' . date("Y-m-d H:i")],
                        'SetFooter' => ['|Wizara ya Kazi, Uwezeshaji, Wazee, Wanawake na Watoto |Page {PAGENO}|'],
                    ]
                ]);
                return $pdf->render();
                exit;

            }
        }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * generates a batch of  Voucher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGenerateVoucher()
    {
        if (!Yii::$app->user->isGuest) {
        $model = new Voucher();
        $model->tarehe_kuandaliwa = date('Y-m-d');
        $model->mwezi = date('m');
        $model->mwaka = date('Y');
        $model->zone_id = Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id);
        $model->kumbukumbu_namba = Reference::findLastVoucher();
        $eligibles = Mzee::getEligible($model->zone_id);
        $model->eligible = count($eligibles);
       // $model->jumla_fedha = $model->eligible * ZupsProduct::getWazeePension();
        $isGenerated = Voucher::findOne(['zone_id' => $model->zone_id,'mwezi' => $model->mwezi,'mwaka' => $model->mwaka]);
        if($isGenerated == null) {
            if ($model->save(false)) {
                foreach ($eligibles as $eligible) {
                    $malipo = new Malipo();
                    $malipo->voucher_id = $model->id;
                    $malipo->shehia_id = $eligible->shehia_id;
                    $malipo->mzee_id = $eligible->id;
                    $malipo->kituo_id = $eligible->kituo_id;
                    $malipo->kiasi = ZupsProduct::getWazeePension($eligible->zups_pension_type);
                    $day1 = date('Y-m-01');
                    $malipo->siku_kwanza = date('Y-m-d', strtotime($day1 . '+14 days'));
                    $malipo->siku_pili = date('Y-m-d', strtotime($day1 . '+15 days'));
                    $malipo->siku_mwisho = date('Y-m-d', strtotime($day1 . '+89 days'));
                    $malipo->status = Budget::OPEN;
                    $malipo->save();
                }
                $model->jumla_fedha = Malipo::find()->where(['voucher_id' => $model->id])->sum('kiasi');
                $model->save();
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-check',
                    'message' => 'Umefanikiwa kuandaa vouchers',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['print-preview', 'id' => $model->id,array('target'=>'_blank')]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 4500,
                'icon' => 'fa fa-check',
                'message' => 'Vouchers za mwezi hii zimeandaliwa tayari',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index']);
        }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Voucher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
        $model = new Voucher();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }



    /**
     * Updates an existing Voucher model.
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
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Voucher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
        try {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }catch (Exception $exception) {
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 4500,
                'icon' => 'fa fa-warning',
                'message' => 'Huwezi kufuta Voucher hii,ina matumizi tayari',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index']);
        }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Voucher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Voucher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Voucher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'edit-status' => [                                       // identifier for your editable action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => Voucher::className(),             // the update model class
                'outputValue' => function ($model, $attribute, $key, $index) {
                    //$fmt = Yii::$app->formatter;
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'status') // selective validation by attribute
                    {
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
