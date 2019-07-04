<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\BudgetMonthlyBalance;
use backend\models\FundBudget;
use backend\models\GharamaMahitaji;
use backend\models\GlDailyBalance;
use backend\models\KituoMonthlyBalances;
use backend\models\Mahitaji;
use backend\models\MahitajiWilaya;
use backend\models\Mkoa;
use backend\models\Product;
use backend\models\Reference;
use backend\models\RejectionReason;
use backend\models\Voucher;
use backend\models\Wafanyakazi;
use backend\models\Wilaya;
use backend\models\Zone;
use backend\models\ZupsBudget;
use common\models\LoginForm;
use Yii;
use backend\models\Budget;
use backend\models\BudgetSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use chrmorandi\jasper\Jasper;

/**
 * BudgetController implements the CRUD actions for Budget model.
 */
class BudgetController extends Controller
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
     * Lists all Budget models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('viewBudget')) {
                $searchModel = new BudgetSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                Audit::setActivity('ameangalia orodha ya budget', 'Budget', 'Index', '', '');
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 5000,
                    'icon' => 'fa fa-warning',
                    'message' => 'hauwezi kuona bajeti',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['site/index']);
            }
        } else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Lists all Budget models.
     * @return mixed
     */
    public function actionMonthly($id)
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('viewBudget')) {
                $searchModel = new BudgetSearch();
                $dataProvider = $searchModel->searchMonthly($id);

                Audit::setActivity('ameangalia orodha ya budget', 'Budget', 'Index', '', '');
                return $this->render('monthly', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 5000,
                    'icon' => 'fa fa-warning',
                    'message' => 'hauwezi kuona bajeti',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['site/index']);
            }
        } else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }



    /**
     * Lists all Budget models.
     * @return mixed
     */
    public function actionPending()
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('viewBudget')) {
            $searchModel = new BudgetSearch();
            $dataProvider = $searchModel->searchPending(Yii::$app->request->queryParams);

            Audit::setActivity('ameangalia orodha ya budget', 'Budget', 'Pending', '', '');
            return $this->render('pending', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 5000,
                    'icon' => 'fa fa-warning',
                    'message' => 'hauwezi kuona bajeti',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['site/index']);
            }
        } else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single Budget model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('viewBudget')) {
            $model=$this->findModel($id);
            $mahitaji = new GharamaMahitaji();
            Audit::setActivity('ameangalia budget'.$model->maelezo, 'Budget', 'View', '', '');
            return $this->render('view', [
                'model' => $this->findModel($id), 'mahitaji' => $mahitaji
            ]);
            }else{
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 5000,
                    'icon' => 'fa fa-warning',
                    'message' => 'hauwezi kuona bajeti',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['site/index']);
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
     * Displays a single Budget model.
     * @param integer $id
     * @return mixed
     */
    public function actionUendeshaji($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);
            $mahitaji = new GharamaMahitaji();
            Audit::setActivity('ameangalia budget'.$model->maelezo, 'Budget', 'View', '', '');
            return $this->render('uendeshaji', [
                'model' => $this->findModel($id), 'mahitaji' => $mahitaji
            ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    public function actionWazee($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);
            Audit::setActivity('ameangalia budget ya wazee'.$model->maelezo, 'Budget', 'View', '', '');
            return $this->render('wazee', [
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


    public function actionSummary()
    {
        if (!Yii::$app->user->isGuest) {
        $model = new Budget();
        Audit::setActivity('ameangalia budget summary', 'Budget', 'View', '', '');
        return $this->render('summary', [
            'model' => $model
        ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionReviewBudget()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new Budget();
            $sababu = new RejectionReason();
            Audit::setActivity('ameangalia budget kuu', 'Budget', 'ReviewBudget', '', '');
            return $this->render('full_budget', [
                'model' => $model,'sababu' => $sababu
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
     * Creates a new Budget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('createBudget')) {
                $model = new Budget();
                $model->kwa_mwaka = date('Y');
                $model->kianzio = BudgetMonthlyBalance::getLastBalanceByZone(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id));
                $model->kumbukumbu_no = Reference::findLast();
                $model->aliyeweka = Yii::$app->user->identity->username;
                $model->muda = date('Y-m-d H:i');
                $model->status = Budget::OPEN;
                $model->zone_id = Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id);

                if ($model->load(Yii::$app->request->post())) {

                    //checking budget creation is within current month
                    $current_month=date('m');
                    if ($current_month == $model->kwa_mwezi) {

                        //checks if budget has been created, if not creates

                        if ($_POST['Budget']['kwa_mwezi'] <= date('m') || $_POST['Budget']['kwa_mwezi'] == date('m') + 1) {

                            $bigbudget = ZupsBudget::find()->where(['mwezi' => $_POST['Budget']['kwa_mwezi'], 'mwaka' => $_POST['Budget']['kwa_mwaka']])->one();
                            if ($bigbudget == null) {
                                $bigbudget = new ZupsBudget();
                                $bigbudget->mwezi = $_POST['Budget']['kwa_mwezi'];
                                $bigbudget->mwaka = $_POST['Budget']['kwa_mwaka'];
                                $bigbudget->aliyeingiza = Yii::$app->user->identity->username;
                                $bigbudget->muda = date('Y-m-d H:i:s');
                                $bigbudget->status = ZupsBudget::OPEN;
                                $bigbudget->save();
                            }
                            //checks the budget has already been created
                            $isexist = Budget::findOne(['zone_id' => $model->zone_id, 'kwa_mwezi' => $bigbudget->mwezi, 'kwa_mwaka' => $bigbudget->mwaka]);
                            if ($isexist == null) {
                                $model->zups_budget_id = $bigbudget->id;
                                $model->save();
                                $mikoa = Mkoa::find()->select(['id'])->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
                                $wilaya = Wilaya::find()->select('id')->where(['in', 'mkoa_id', $mikoa]);
                                $wilayaMahitaji = MahitajiWilaya::find()->where(['in', 'wilaya_id', $wilaya])->all();
                                if ($wilayaMahitaji != null) {

                                    foreach ($wilayaMahitaji as $wilaya) {
                                        $budget = new GharamaMahitaji();
                                        $budget->budget_id = $model->id;
                                        $budget->hitaji_id = $wilaya->hitaji_id;
                                        $budget->wilaya_id = $wilaya->wilaya_id;
                                        $budget->idadi_ya_siku = 2;
                                        $budget->idadi_ya_vitu = 0;
                                        $budget->gharama = 0.00;
                                        $budget->total = 0.00;
                                        $budget->save();
                                    }

                                }
                                $ofisimahitaji = Mahitaji::find()->where(['aina_ya_hitaji' => 1])->all();
                                if ($ofisimahitaji != null) {

                                    foreach ($ofisimahitaji as $ofisi) {
                                        $budget = new GharamaMahitaji();
                                        $budget->budget_id = $model->id;
                                        $budget->hitaji_id = $ofisi->id;
                                        $budget->wilaya_id = '';
                                        $budget->idadi_ya_siku = 0;
                                        $budget->idadi_ya_vitu = 0;
                                        $budget->gharama = 0.00;
                                        $budget->total = 0.00;
                                        $budget->save();
                                    }
                                    Yii::$app->session->setFlash('', [
                                        'type' => 'warning',
                                        'duration' => 5000,
                                        'icon' => 'fa fa-check',
                                        'message' => 'Umefanikiwa kuunda',
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);
                                }

                                //closing all budgets in this zone
                                $condition = ['and',
                                    ['zone_id' => $model->zone_id],
                                    ['!=', 'id', $model->id],
                                ];

                                Budget::updateAll(['status' => Budget::CLOSED], $condition);
                                Audit::setActivity('ameunda budget' . '(' . $model->maelezo . ')', 'Budget', 'Create', '', '');


                                return $this->redirect(['view', 'id' => $model->id]);
                            } else {
                                Yii::$app->session->setFlash('', [
                                    'type' => 'danger',
                                    'duration' => 5000,
                                    'icon' => 'fa fa-warning',
                                    'message' => 'Budget kama hii imeshaundwa tayari',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);
                                return $this->redirect(['index']);
                            }
                        }else{
                            Yii::$app->session->setFlash('', [
<<<<<<< HEAD
                                'type' => 'warning',
                               'duration' => 5000,
                                'icon' => 'fa fa-check',
                                'message' => 'Umefanikiwa kuingiza bajeti',
=======
                                'type' => 'danger',
                                'duration' => 5000,
                                'icon' => 'fa fa-warning',
                                'message' => 'Huwezi unda budget ya miezi zaid ya mmoja',
>>>>>>> ca4906fb2036137392ccfaa209da31894906c1a8
                                'positonY' => 'top',
                                'positonX' => 'right'
                            ]);
                            return $this->redirect(['index']);
                        }


                    }

                    else {
                        Yii::$app->session->setFlash('', [
                            'type' => 'danger',
                            'duration' => 5000,
                            'icon' => 'fa fa-warning',
                            'message' => 'Bujeti haiwezi kuwa nje ya mwezi husika wa malipo',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(['index']);
                    }
<<<<<<< HEAD
                }else{
                         Yii::$app->session->setFlash('', [
                             'type' => 'danger',
                            'duration' => 5000,
                             'icon' => 'fa fa-warning',
                             'message' => 'Huwezi kuingiza budget ya miezi zaid ya mmoja',
                             'positonY' => 'top',
                             'positonX' => 'right'
                         ]);
                         return $this->redirect(['index']); 
                     }
                    } else {
=======

                    }



                else {

>>>>>>> ca4906fb2036137392ccfaa209da31894906c1a8
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
                }
            else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'danger',
                       'duration' => 5000,
                        'icon' => 'fa fa-warning',
                        'message' => 'Hauna uwezo wa kuingiza budget',
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

    public function actionClone($id)
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('createBudget')) {
                $model = $this->findModel($id);
                $newModel = new Budget();
                $newModel->maelezo = $model->maelezo;
                $newModel->kwa_mwezi = sprintf("%02d", ($model->kwa_mwezi + 1));
                if ($newModel->kwa_mwezi == 13) {
                    $newModel->kwa_mwezi = 01;
                    $newModel->kwa_mwaka = $model->kwa_mwaka + 1;
                } else {
                    $newModel->kwa_mwaka = $model->kwa_mwaka;
                }
                if ($newModel->kwa_mwezi <= date('m') || $newModel->kwa_mwezi == date('m') + 1) {
                $newModel->kwa_mwaka = date('Y');
                $newModel->kianzio = BudgetMonthlyBalance::getLastBalanceByZone(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id));
                $newModel->kumbukumbu_no = Reference::findLast();
                $newModel->aliyeweka = Yii::$app->user->identity->username;
                $newModel->muda = date('Y-m-d H:i');
                $newModel->status = Budget::OPEN;
                $newModel->zone_id = Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id);

                $bigbudget = ZupsBudget::find()->where(['mwezi' => $newModel->kwa_mwezi, 'mwaka' => $newModel->kwa_mwaka])->one();
                if ($bigbudget == null) {
                    $bigbudget = new ZupsBudget();
                    $bigbudget->mwezi = $newModel->kwa_mwezi;
                    $bigbudget->mwaka = $newModel->kwa_mwaka;
                    $bigbudget->aliyeingiza = Yii::$app->user->identity->username;
                    $bigbudget->muda = date('Y-m-d H:i:s');
                    $bigbudget->status = ZupsBudget::OPEN;
                    $bigbudget->save(false);
                    $newModel->zups_budget_id = $bigbudget->id;

                    $isexist = Budget::findOne(['zone_id' => $newModel->zone_id, 'kwa_mwezi' => $newModel->kwa_mwezi, 'kwa_mwaka' => $newModel->kwa_mwaka]);
                    if ($isexist == null) {

                        if ($newModel->save(false)) {

                            $Mahitaji = GharamaMahitaji::find()->where(['budget_id' => $model->id])->all();
                            if ($Mahitaji != null) {

                                foreach ($Mahitaji as $hitaji) {
                                    $budget = new GharamaMahitaji();
                                    $budget->budget_id = $newModel->id;
                                    $budget->hitaji_id = $hitaji->hitaji_id;
                                    $budget->wilaya_id = $hitaji->wilaya_id;
                                    $budget->idadi_ya_siku = $hitaji->idadi_ya_siku;
                                    $budget->idadi_ya_vitu = $hitaji->idadi_ya_vitu;
                                    $budget->gharama = $hitaji->gharama;
                                    $budget->total = $hitaji->total;
                                    $budget->save();
                                }


                                Yii::$app->session->setFlash('', [
                                    'type' => 'warning',
                                    'duration' => 5000,
                                    'icon' => 'fa fa-check',
                                    'message' => 'Umefanikiwa kukopi budget',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);

                                //closing all budgets in this zone
                                $condition = ['and',
                                    ['zone_id' => $newModel->zone_id],
                                    ['!=', 'id', $newModel->id],
                                ];
                                Budget::updateAll(['status' => Budget::CLOSED], $condition);
                                Audit::setActivity('amekopi budget' . '(' . $newModel->maelezo . ')', 'Budget', 'Create', '', '');
                                return $this->redirect(['view', 'id' => $newModel->id]);
                            }
                        } else {
                            return $this->render('create', [
                                'model' => $model,
                            ]);
                        }
                    } else {

                        $newBudget = new Budget();
                        $newBudget->status = Budget::OPEN;
                        $newBudget->kwa_mwezi = $newModel->kwa_mwezi;
                        $newBudget->kwa_mwaka = $newModel->kwa_mwaka;
                        $newBudget->kumbukumbu_no = Reference::findLast();
                        $newBudget->aliyeweka = Yii::$app->user->identity->username;
                        $newBudget->muda = date('Y-m-d H:i:s');
                        $newBudget->zone_id = Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id);
                        $newBudget->zups_budget_id = $newModel->zups_budget_id;
                        if ($newBudget->save()) {
                            $Mahitaji = GharamaMahitaji::find()->where(['budget_id' => $model->id])->all();
                            if ($Mahitaji != null) {

                                foreach ($Mahitaji as $hitaji) {
                                    $budget = new GharamaMahitaji();
                                    $budget->budget_id = $newModel->id;
                                    $budget->hitaji_id = $hitaji->hitaji_id;
                                    $budget->wilaya_id = $hitaji->wilaya_id;
                                    $budget->idadi_ya_siku = $hitaji->idadi_ya_siku;
                                    $budget->idadi_ya_vitu = $hitaji->idadi_ya_vitu;
                                    $budget->gharama = $hitaji->gharama;
                                    $budget->total = $hitaji->total;
                                    $budget->save();
                                }


                                Yii::$app->session->setFlash('', [
                                    'type' => 'warning',
                                    'duration' => 5000,
                                    'icon' => 'fa fa-check',
                                    'message' => 'Umefanikiwa kukopi budget',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);

                                //closing all budgets in this zone
                                $condition = ['and',
                                    ['zone_id' => $newBudget->zone_id],
                                    ['!=', 'id', $newBudget->id],
                                ];
                                Budget::updateAll(['status' => Budget::CLOSED], $condition);
                                Audit::setActivity('amekopi budget' . '(' . $newBudget->maelezo . ')', 'Budget', 'Create', '', '');
                                return $this->redirect(['view', 'id' => $newBudget->id]);
                            }
                        }
                    }
                } else {
                    // print_r('yes bro');
                    //  exit;
                    $isexist = Budget::findOne(['zone_id' => $newModel->zone_id, 'kwa_mwezi' => $newModel->kwa_mwezi, 'kwa_mwaka' => $newModel->kwa_mwaka]);
                    if ($isexist == null) {
                        $newModel->zups_budget_id = $bigbudget->id;

                        if ($newModel->save(false)) {

                            $Mahitaji = GharamaMahitaji::find()->where(['budget_id' => $model->id])->all();
                            if ($Mahitaji != null) {

                                foreach ($Mahitaji as $hitaji) {
                                    $budget = new GharamaMahitaji();
                                    $budget->budget_id = $newModel->id;
                                    $budget->hitaji_id = $hitaji->hitaji_id;
                                    $budget->wilaya_id = $hitaji->wilaya_id;
                                    $budget->idadi_ya_siku = $hitaji->idadi_ya_siku;
                                    $budget->idadi_ya_vitu = $hitaji->idadi_ya_vitu;
                                    $budget->gharama = $hitaji->gharama;
                                    $budget->total = $hitaji->total;
                                    $budget->save();
                                }


                                Yii::$app->session->setFlash('', [
                                    'type' => 'warning',
                                    'duration' => 5000,
                                    'icon' => 'fa fa-check',
                                    'message' => 'Umefanikiwa kukopi budget',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);

                                //closing all budgets in this zone
                                $condition = ['and',
                                    ['zone_id' => $newModel->zone_id],
                                    ['!=', 'id', $newModel->id],
                                ];
                                Budget::updateAll(['status' => Budget::CLOSED], $condition);
                                Audit::setActivity('amekopi budget' . '(' . $newModel->maelezo . ')', 'Budget', 'Create', '', '');
                                return $this->redirect(['view', 'id' => $newModel->id]);
                            }
                        } else {
                            return $this->render('create', [
                                'model' => $model,
                            ]);
                        }
                    } else {
                        $zupsBudget = ZupsBudget::find()->where(['or','mwezi',date('m'),sprintf("%02d",(date('m')+1))])->one();
                        $bigbudget1 = new ZupsBudget();
                        $newBudget1 = new Budget();
                        $bigbudget1->mwezi = sprintf("%02d", ($zupsBudget->mwezi + 1));
                        if ($bigbudget1->mwezi == 13) {
                            $bigbudget1->mwezi = 01;
                            $bigbudget1->mwaka = $zupsBudget->mwaka + 1;
                        } else {
                            $bigbudget1->mwaka = $zupsBudget->mwaka;
                        }
                        $bigbudget1->aliyeingiza = Yii::$app->user->identity->username;
                        $bigbudget1->muda = date('Y-m-d H:i:s');
                        $bigbudget1->status = ZupsBudget::OPEN;
                        $checkBigBudget = ZupsBudget::find()->where(['mwezi' => $bigbudget1->mwezi,'mwaka' => $bigbudget1->mwaka])->one();
                        if($checkBigBudget == null) {
                            $bigbudget1->save(false);
                            $newBudget1->zups_budget_id = $bigbudget1->id;
                            $newBudget1->kwa_mwaka = $bigbudget1->mwaka;
                            $newBudget1->kwa_mwezi = $bigbudget1->mwezi;
                        }else{
                            $newBudget1->zups_budget_id = $checkBigBudget->id;
                            $newBudget1->kwa_mwezi = $checkBigBudget->mwezi;
                            $newBudget1->kwa_mwaka = $checkBigBudget->mwaka;
                        }




                        $newBudget1->status = Budget::OPEN;
                        $newBudget1->kumbukumbu_no = Reference::findLast();
                        $newBudget1->aliyeweka = Yii::$app->user->identity->username;
                        $newBudget1->muda = date('Y-m-d H:i:s');
                        $newBudget1->zone_id = Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id);
                        $checkBudget = Budget::find()->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id),'kwa_mwezi' => $newBudget1->kwa_mwezi,'kwa_mwaka' => $newBudget1->kwa_mwaka])->one();
                        if($checkBudget == null){
                        if ($newBudget1->save()) {
                            $Mahitaji1 = GharamaMahitaji::find()->where(['budget_id' => $model->id])->all();

                            if ($Mahitaji1 != null) {

                                foreach ($Mahitaji1 as $hitaji) {
                                    $budget = new GharamaMahitaji();
                                    $budget->budget_id = $newBudget1->id;
                                    $budget->hitaji_id = $hitaji->hitaji_id;
                                    $budget->wilaya_id = $hitaji->wilaya_id;
                                    $budget->idadi_ya_siku = $hitaji->idadi_ya_siku;
                                    $budget->idadi_ya_vitu = $hitaji->idadi_ya_vitu;
                                    $budget->gharama = $hitaji->gharama;
                                    $budget->total = $hitaji->total;
                                    $budget->save();
                                    //print_r($budget);
                                    // exit;
                                }


                                Yii::$app->session->setFlash('', [
                                    'type' => 'warning',
                                    'duration' => 5000,
                                    'icon' => 'fa fa-check',
                                    'message' => 'Umefanikiwa kukopi budget',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);

                                //closing all budgets in this zone
                                $condition = ['and',
                                    ['zone_id' => $newBudget1->zone_id],
                                    ['!=', 'id', $newBudget1->id],
                                ];
                                Budget::updateAll(['status' => Budget::CLOSED], $condition);
                                Audit::setActivity('amekopi budget' . '(' . $newBudget1->maelezo . ')', 'Budget', 'Create', '', '');
                                return $this->redirect(['view', 'id' => $newBudget1->id]);
                            }
                        }
                        }else{
                            Yii::$app->session->setFlash('', [
                                'type' => 'danger',
                                'duration' => 5000,
                                'icon' => 'fa fa-warning',
                                'message' => 'Budget kama hii imeshaundwa tayari',
                                'positonY' => 'top',
                                'positonX' => 'right'
                            ]);
                            return $this->redirect(['index']);
                        }


                    }


                }
            }else{
                    Yii::$app->session->setFlash('', [
                        'type' => 'danger',
                        'duration' => 5000,
                        'icon' => 'fa fa-warning',
                        'message' => 'Huwezi unda budget ya miezi zaid ya mmoja',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->redirect(['index']);
                }
            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                   'duration' => 5000,
                    'icon' => 'fa fa-warning',
                    'message' => 'Hauna uwezo wa kuunda budget',
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
     * Updates an existing Budget model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('createBudget')) {
                $model = $this->findModel($id);
                $beforesave = $model->attributes;
                $model->setScenario('pension-officer-update');

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    $aftersave = $model->attributes;
                    Audit::setActivity('amefanya marekebisho ya budget' . '(' . $model->maelezo . ')', 'Budget', 'Update', $beforesave, $aftersave);
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                   'duration' => 5000,
                    'icon' => 'fa fa-warning',
                    'message' => 'Hauna uwezo wa kuunda budget',
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

    public function actionFunga($id)
    {
        if(Yii::$app->user->can('closeBudget')) {
            $model = $this->findModel($id);
            $model->status = Budget::CLOSED;
            //calculates remaining budget
            //gets last budget closed per zone
            $lastBudget = Budget::getLastBudget();
            $fundedBudget = FundBudget::find()->where(['budget_id' => $lastBudget->id])->one();
            if ($fundedBudget != null) {
                $budgetBalance = new BudgetMonthlyBalance();
                $budgetBalance->opening_balance = $fundedBudget->kiasi_kilichotolewa;
                $budgetBalance->budget_id = $lastBudget->id;
                if (Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::UNGUJA) {
                    $glcode = 'UG0003';
                } elseif (Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id) == Zone::PEMBA) {
                    $glcode = 'PM0003';
                }
                $budgetBalance->closing_balance = KituoMonthlyBalances::getBalancePerZone(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id), $lastBudget->kwa_mwezi, $lastBudget->kwa_mwaka) + GlDailyBalance::getCurrentBalance($glcode);
                $budgetBalance->balance = $budgetBalance->closing_balance;
            }
            $budgetBalance->save(false);
            $model->save(false);
            Yii::$app->session->setFlash('', [
                'type' => 'success',
                'duration' => 5000,
                'icon' => 'fa fa-check',
                'message' => 'Umefanikiwa kufunga zoezi',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

            return $this->redirect(['site/index']);
        }else{
            Yii::$app->session->setFlash('', [
                'type' => 'danger',
                'duration' => 5000,
                'icon' => 'fa fa-warning',
                'message' => 'Hauna uwezo wa kufunga zoezi la malipo',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
        }
    }

    /**
     * Deletes an existing Budget model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->can('deleteBudget')) {
                try {
                    $model=$this->findModel($id);
                    $this->findModel($id)->delete();
                    Audit::setActivity('amefuta  budget' . '(' . $model->kumbukumbu_no . ')', 'Budget', 'Delete', '', '');

                    return $this->redirect(['index']);
                }catch (Exception $exception) {
                    Yii::$app->session->setFlash('', [
                        'type' => 'danger',
                       'duration' => 5000,
                        'icon' => 'fa fa-warning',
                        'message' => 'Huwezi kufuta budget hii,ina matumizi tayari',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    Audit::setActivity('anajaribu kufuta budget iliyotumika tayari' . '(' . $model->kumbukumbu_no . ')', 'Budget', 'Delete', '', '');
                    return $this->redirect(['index']);
                }
            } else {
                Yii::$app->session->setFlash('', [
                    'type' => 'danger',
                   'duration' => 5000,
                    'icon' => 'fa fa-warning',
                    'message' => 'Hauna uwezo wa kufuta budget',
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


    public function actionGetWazee($id)
    {
        if(!Yii::$app->user->isGuest) {
            $budget = Budget::find()
                ->where(['id' => $id])
                ->one();
            return $budget->wazee;
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }


    public function actionGetUendeshaji($id)
    {
        if(!Yii::$app->user->isGuest) {
            $budget = Budget::find()
                ->where(['id' => $id])
                ->one();
            return $budget->uendeshaji;
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionGetJumla($id)
    {
        if(!Yii::$app->user->isGuest) {
            $budget = Budget::find()
                ->where(['id' => $id])
                ->one();
            return $budget->jumla_kiasi;
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }



    //budget approval

    public function actionBulkApprove()
    {

        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('approveBudget')) {
                $action = Yii::$app->request->post('action');
                $selection = (array)Yii::$app->request->post('selection');//typecasting
                if ($selection) {
                    foreach ($selection as $id) {
                        $budget = Budget::findOne((int)$id);//make a typecasting
                        // print_r($malipo->id.' - '. $id);
                        //  exit;

                        if ($budget->status == Budget::WAITING_FUND) {
                            Voucher::updateAll(['status' => Voucher::CLOSED],['zone_id' => $budget->zone_id,'mwezi' => $budget->kwa_mwezi,'mwaka' => $budget->kwa_mwaka]);
                            //return array('success' => false, 'error_code' => 300, 'error' => 'Already paid');
                            //paid
                        } else {
                            $budget->status = Budget::WAITING_FUND;
                            $budget->aliyethitisha = Yii::$app->user->identity->username;
                            $budget->muda_kuthibitisha = date('Y-m-d H:i:s');
                            $uendashaji = GharamaMahitaji::getSum($id);
                            if($budget->save(false)){
                                Budget::updateAll(['uendeshaji' => $uendashaji,'jumla_kiasi' => ($budget->wazee + $uendashaji)],['id' => $budget->id]);
                                Voucher::updateAll(['status' => Voucher::CLOSED],['zone_id' => $budget->zone_id,'mwezi' => $budget->kwa_mwezi,'mwaka' => $budget->kwa_mwaka]);
                            }

                        }

                        //
                    }
                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 3000,
                        'icon' => 'fa fa-check',
                        'message' => 'umefanikiwa kuthibitisha budget',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['pending']);
                }
                else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                       'duration' => 5000,
                        'icon' => 'fa fa-warning',
                        'message' => 'haujachagua budget yoyote',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['pending']);
                }



            }else {
                //you are not allowed
            }

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    /**
     * Finds the Budget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Budget the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Budget::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
