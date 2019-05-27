<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\KituoShehia;
use backend\models\MaoniKwaMzee;
use backend\models\MsadiziWazeeWengine;
use backend\models\MsaidiziMzee;
use backend\models\MzeeMagonjwa;
use backend\models\MzeeMsaidiziWengine;
use backend\models\MzeeUlemavu;
use backend\models\MzeeVipato;
use backend\models\Shehia;
use backend\models\UhakikiForm;
use backend\models\ViambatanishoMzee;
use backend\models\Wafanyakazi;
use backend\models\WazeeWaliotenguliwa;
use backend\models\ZupsProduct;
use common\models\LoginForm;
use DateTime;
use Yii;
use backend\models\Mzee;
use backend\models\MzeeSearch;
use yii\bootstrap\ActiveForm;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

ini_set('memory_limit', '1024M');

/**
 * MzeeController implements the CRUD actions for Mzee model.
 */
class MzeeController extends Controller
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
                    'approve' => ['POST'],
                    'confirm' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Mzee models.
     * @return mixed
     */

    public function actionEligibles()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('DataClerk')) {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchMzeeByDistrictWorker(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya wazee', 'Wazee', 'Index', '', '');
                return $this->render('eligibles', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya wazee', 'Wazee', 'Index', '', '');
                return $this->render('eligibles', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('DataClerk')) {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchMzeeByDistrictWorker(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya wazee', 'Wazee', 'Index', '', '');
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya wazee', 'Wazee', 'Index', '', '');
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    public function actionSearchAll()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('DataClerk')) {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchMzeeByDistrictWorker(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya wazee', 'Wazee', 'Index', '', '');
                return $this->render('all', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya wazee', 'Wazee', 'Index', '', '');
                return $this->render('all', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }


    public function actionWithFinger()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('DataClerk')) {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchWithFingerByDistrictWorker(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya wazee wenye finger print', 'Wazee', 'Index', '', '');
                return $this->render('with_finger', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }else {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchWithFinger(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya wazee wenye finger print', 'Wazee', 'Index', '', '');
                return $this->render('with_finger', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }


    }

    public function actionDisableMsaidizi($id)
    {
        if (!Yii::$app->user->isGuest) {
            $mzee = $this->findModel($id);
            Mzee::updateAll(['msaidizi_id' => null], ['id' => $id]);
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 1500,
                'icon' => 'fa fa-check',
                'message' => 'Umefanikiwa kumfuta mzee',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            Audit::setActivity('Amemfuta msaidizi' . $mzee->msaidizi_id . ' kwa mzee huyu ' . $mzee->majina_mwanzo . ' ' . $mzee->jina_babu, 'Wazee', 'Disable', '', '');
            return $this->redirect(['msaidizi-mzee/view', 'id' => $mzee->msaidizi_id]);

        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionLoadMzee($id)
    {
        $mzee = $this->findModel($id);
        if ($mzee != null) {
            $sms = '<div class="row"><div class="col-xs-6"><table>
             <tr>
                   <td style="display: none">ID</td>
                  <td style="display: none" id="mzee-id">' . $mzee->id . '</td>
                  </tr>
            <tr>
                   <td>Jina kamili</td>
                  <td>' . $mzee->majina_mwanzo . ' ' . $mzee->jina_babu . '</td>
                  </tr>
             <tr>
                   <td>Kitambulisho:</td>
                  <td>' . $mzee->nambar . '</td>
                  </tr>
             <tr>
                   <td>Aina ya kitambulisho: </td>';
            if ($mzee->aina_ya_kitambulisho != null) {
                $sms1 = '<td > ' . $mzee->kitambulisho->jina . '</td>';

            } else {
                $sms1 = '<td ></td>';
            }
            $sms3 = '</tr>
             </table></div> <div class="col-xs-6">
      
             </div></div>';
            return $sms . $sms1 . $sms3;
        } else {
            return false;
        }

    }

    /**
     * Displays a single Mzee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {

            $model = $this->findModel($id);
            $kiambatanisho = new ViambatanishoMzee();
            $wazee = new MzeeMsaidiziWengine();
            $msaidiz = MsaidiziMzee::findOne(['id' => $model->msaidizi_id]);
            $sababu = new MaoniKwaMzee();
            $uhakiki = new UhakikiForm();
            $restore = new WazeeWaliotenguliwa();
            if ($msaidiz != null) {
                $msaidiz->mzee_id = $id;
            }
            $searchModel = new MzeeSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            Audit::setActivity('Ameangalia taarifa za mzee mwenye id' . $model->nambar . ', anaeitwa ' . $model->majina_mwanzo . ' ' . $model->jina_babu, 'Wazee', 'View', '', '');
            return $this->render('view', [
                'model' => $model, 'kiambatanisho' => $kiambatanisho, 'restore' => $restore, 'msaidiz' => $msaidiz, 'sababu' => $sababu, 'uhakiki' => $uhakiki, 'wazee' => $wazee
            ]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionUpdateMsaidizi($id, $msid)
    {
        if (!Yii::$app->user->isGuest) {
            $mzee = $this->findModel($id);
            $msaidizi = new MsaidiziMzee();
            $beforesave = $mzee->attributes;
            if ($mzee != null) {

                if (Mzee::updateAll(['msaidizi_id' => $msid], ['id' => $id])) {
                    MsaidiziMzee::updateAll(['mzee_id' => $id], ['id' => $msid]);
                    $mzee = $this->findModel($id);
                    $aftersave = $mzee->attributes;
                    Audit::setActivity('Amemuingiza msaidizi mpya ' . $mzee->msaidizi_id . ', anaeitwa ' . $mzee->msaidizi->jina_kamili, 'Wazee', 'Update', $beforesave, $aftersave);
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Mzee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new Mzee();
            $msaidizi = new MsaidiziMzee();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            $model->aliyeweka = Yii::$app->user->identity->username;
            $model->muda = date('Y-m-d H:i');
            $model->status = Mzee::PENDING;
            $model->anaishi = '1';
            $model->tarehe_ya_usajili = date('Y-m-d H:i');

            $msaidizi->aliyemuweka = Yii::$app->user->identity->username;
            $msaidizi->muda = date('Y-m-d H:i');

            $msaidizi->aliyemuweka = Yii::$app->user->identity->username;
            $msaidizi->muda = date('Y-m-d H:i');
            if ($model->load(Yii::$app->request->post()) && $msaidizi->load(Yii::$app->request->post())) {

                if (empty($_POST['Mzee']['tarehe_kuingia_zanzibar'])) {
                    $model->tarehe_kuingia_zanzibar = '';
                }

                $model->mzee_picha = UploadedFile::getInstance($model, 'mzee_picha');
                $model->tarehe_kuzaliwa = date('Y-m-d', strtotime($_POST['Mzee']['tarehe_kuzaliwa']));
                $model->kituo_id = KituoShehia::getKituoIdByShehiaId($_POST['Mzee']['shehia_id']);
                if ($model->kituo_id == null) {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 3000,
                        'icon' => 'fa fa-warning',
                        'message' => 'Tafadhari ingiza taarifa za vituo vya malipo na shehia zake',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                }

                if ($model->mzee_picha != null) {
                    $model->mzee_picha->saveAs('uploads/wazee/' . $model->mzee_picha . '.' . $model->mzee_picha->extension);
                    $model->picha = $model->mzee_picha . '.' . $model->mzee_picha->extension;
                }

                if ($_POST['Mzee']['mzawa_zanzibar'] == 'N' && $_POST['Mzee']['tarehe_kuingia_zanzibar'] == " ") {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 3000,
                        'icon' => 'fa fa-warning',
                        'message' => 'Ingiza tarehe ya kuingia zanzibar',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                }

                if ($model->save()) {
                    $array = $model->magonjwa;
                    $array1 = $model->ulemavu;
                    $array2 = $model->vipato;
                    if ($array != null) {
                        foreach ($array as $ugonjwa) {
                            $ug = new MzeeMagonjwa();
                            $ug->mzee_id = $model->id;
                            $ug->ugonjwa_id = $ugonjwa;
                            $ug->save();
                        }
                    }
                    if ($array1 != null) {
                        foreach ($array1 as $ulemavu) {
                            $ug = new MzeeUlemavu();
                            $ug->mzee_id = $model->id;
                            $ug->ulemavu_id = $ulemavu;
                            $ug->save();
                        }
                    }
                    if ($array2 != null) {
                        foreach ($array2 as $kipato) {
                            $ug = new MzeeVipato();
                            $ug->mzee_id = $model->id;
                            $ug->kipato_id = $kipato;
                            $ug->save();
                        }
                    }
                    $msaidizi->tarehe_kuzaliwa = date('Y-m-d', strtotime($_POST['MsaidiziMzee']['tarehe_kuzaliwa']));

                    $msaidizi->msaidizi_picha = UploadedFile::getInstance($msaidizi, 'msaidizi_picha');
                    $msaidizi->mzee_id = $model->id;
                    $msaidizi->mkoa_id = $_POST['MsaidiziMzee']['mkoa_id'];
                    $msaidizi->status = MsaidiziMzee::ACTIVE;
                    Mzee::updateAll(['aina_ya_msaidizi' => 1], ['id' => $model->id]);


                    if ($msaidizi->msaidizi_picha != null) {
                        $msaidizi->msaidizi_picha->saveAs('uploads/wasaidizi/' . date('YmdHi') . '.' . $msaidizi->msaidizi_picha->extension);
                        $msaidizi->picha = date('YmdHi') . '.' . $msaidizi->msaidizi_picha->extension;
                    }

                    if ($msaidizi->save()) {
                        Mzee::updateAll(['msaidizi_id' => $msaidizi->id], ['id' => $model->id]);
                        $msaidiziWazee = new MsadiziWazeeWengine();
                        $msaidiziWazee->msaidizi_id = $msaidizi->id;
                        $msaidiziWazee->mzee_id = $model->id;
                        $msaidiziWazee->added_by = Yii::$app->user->identity->username;
                        $msaidiziWazee->date_added = date('Y-m-d H:i:s');
                        $msaidiziWazee->status = 0;
                        $msaidiziWazee->save();
                        Yii::$app->session->setFlash('', [
                            'type' => 'warning',
                            'duration' => 1500,
                            'icon' => 'fa fa-check',
                            'message' => 'Usajili umekamilika',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                    /*   else{
                           print_r('not saved');
                       }*/

                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 3000,
                        'icon' => 'fa fa-check',
                        'message' => 'Usajili umekamilika',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    Audit::setActivity('Amemuingiza mzee mpya ' . $model->id . ', anaeitwa ' . $model->majina_mwanzo . ' ' . $model->jina_babu, 'Wazee', 'Create', '', '');

                    //  return $this->redirect(['view','id'=>$model->id]);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
                'msaidizi' => $msaidizi,
            ]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }


    /**
     * Updates an existing Mzee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);
            $model->aliyeweka = Yii::$app->user->identity->username;
            $model->muda = date('Y-m-d H:i');
            $beforesave = $model->attributes;
            $beforeID = $model->nambar;


            if ($model->load(Yii::$app->request->post())) {
                $model->kituo_id = KituoShehia::getKituoIdByShehiaId($_POST['Mzee']['shehia_id']);
                if ($model->kituo_id == null) {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 1500,
                        'icon' => 'fa fa-warning',
                        'message' => 'Tafadhari ingiza taarifa za vituo vya malipo na shehia zake',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
                if ($beforeID != trim($model->nambar)) {
                    $mzeeid = Mzee::findOne(['nambar' => $_POST['Mzee']['nambar'], 'aina_ya_kitambulisho' => $_POST['Mzee']['aina_ya_kitambulisho']]);
                    $mzeemsaidizi = MsaidiziMzee::findOne(['aina_ya_kitambulisho' => $_POST['Mzee']['aina_ya_kitambulisho'], 'nambari_ya_kitambulisho' => $_POST['Mzee']['nambar']]);
                    if ($mzeeid != null || $mzeemsaidizi != null) {
                        Yii::$app->session->setFlash('', [
                            'type' => 'warning',
                            'duration' => 3000,
                            'icon' => 'fa fa-warning',
                            'message' => 'Namba ya kitambulisho cha mzee imeshatumika tayari',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    }

                }

                if (UploadedFile::getInstance($model, 'mzee_picha') != null) {
                    $model->picha = UploadedFile::getInstance($model, 'mzee_picha');
                    if ($_POST['Mzee']['tarehe_kuzaliwa'] != null) {
                        $model->tarehe_kuzaliwa = date('Y-m-d', strtotime($_POST['Mzee']['tarehe_kuzaliwa']));
                    }
                    $model->tarehe_kuingia_zanzibar = date('Y-m-d', strtotime($_POST['Mzee']['tarehe_kuingia_zanzibar']));


                    $model->picha->saveAs('uploads/wazee/' . $model->picha . '.' . $model->picha->extension);
                    $model->picha = $model->picha . '.' . $model->picha->extension;

                    if ($_POST['Mzee']['mzawa_zanzibar'] == 'N' && $_POST['Mzee']['tarehe_kuingia_zanzibar'] == " ") {
                        $model->save();
                        Yii::$app->session->setFlash('', [
                            'type' => 'warning',
                            'duration' => 3000,
                            'icon' => 'fa fa-check',
                            'message' => 'marekebisho yamefanikiwa',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    } else {
                        if ($model->save()) {
                            $aftersave = $model->attributes;
                            MzeeMagonjwa::deleteAll(['mzee_id' => $id]);
                            MzeeUlemavu::deleteAll(['mzee_id' => $id]);
                            MzeeVipato::deleteAll(['mzee_id' => $id]);
                            $array = $model->magonjwa;
                            $array1 = $model->ulemavu;
                            $array2 = $model->vipato;
                            if ($array != null) {
                                foreach ($array as $ugonjwa) {
                                    $ug = new MzeeMagonjwa();
                                    $ug->mzee_id = $model->id;
                                    $ug->ugonjwa_id = $ugonjwa;
                                    $ug->save();
                                }
                            }
                            if ($array1 != null) {
                                foreach ($array1 as $ulemavu) {
                                    $ug = new MzeeUlemavu();
                                    $ug->mzee_id = $model->id;
                                    $ug->ulemavu_id = $ulemavu;
                                    $ug->save();
                                }
                            }
                            if ($array2 != null) {
                                foreach ($array2 as $kipato) {
                                    $ug = new MzeeVipato();
                                    $ug->mzee_id = $model->id;
                                    $ug->kipato_id = $kipato;
                                    $ug->save();
                                }
                            }

                            Yii::$app->session->setFlash('', [
                                'type' => 'warning',
                                'duration' => 3000,
                                'icon' => 'fa fa-check',
                                'message' => 'Usajili umekamilika',
                                'positonY' => 'top',
                                'positonX' => 'right'
                            ]);
                            Audit::setActivity('Amefanya marekebisho ya mzee ', 'Wazee', 'Update', $beforesave, $aftersave);


                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            print_r($model);
                        }
                    }
                } else {
                    $model->save();
                    $aftersave = $model->attributes;
                    MzeeMagonjwa::deleteAll(['mzee_id' => $id]);
                    MzeeUlemavu::deleteAll(['mzee_id' => $id]);
                    MzeeVipato::deleteAll(['mzee_id' => $id]);
                    $array = $model->magonjwa;
                    $array1 = $model->ulemavu;
                    $array2 = $model->vipato;
                    if ($array != null) {
                        foreach ($array as $ugonjwa) {
                            $ug = new MzeeMagonjwa();
                            $ug->mzee_id = $model->id;
                            $ug->ugonjwa_id = $ugonjwa;
                            $ug->save();
                        }
                    }
                    if ($array1 != null) {
                        foreach ($array1 as $ulemavu) {
                            $ug = new MzeeUlemavu();
                            $ug->mzee_id = $model->id;
                            $ug->ulemavu_id = $ulemavu;
                            $ug->save();
                        }
                    }
                    if ($array2 != null) {
                        foreach ($array2 as $kipato) {
                            $ug = new MzeeVipato();
                            $ug->mzee_id = $model->id;
                            $ug->kipato_id = $kipato;
                            $ug->save();
                        }
                    }

                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 3000,
                        'icon' => 'fa fa-check',
                        'message' => 'marekebisho yamefanikiwa',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    Audit::setActivity('Amefanya marekebisho ya mzee ', 'Wazee', 'Update', $beforesave, $aftersave);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->magonjwa = ArrayHelper::map($model->mzeeMagonjwa, 'id', 'ugonjwa_id');
                $model->vipato = ArrayHelper::map($model->mzeeVipato, 'id', 'kipato_id');
                $model->ulemavu = ArrayHelper::map($model->mzeeUlemavu, 'id', 'ulemavu_id');
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }


    }

    public function actionPending()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('DataClerk')) {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchPendingMzeeByDistrictWorker(Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id));
                Audit::setActivity('Ameangalia wazee wanaosubiri uhakiki ', 'Wazee', 'Pending', '', '');
                return $this->render('pending', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchPending(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia wazee wanaosubiri uhakiki', 'Wazee', 'Pending', '', '');
                return $this->render('pending', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }


    public function actionWithSeventy()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('DataClerk')) {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchWithSeventyMzeeByDistrictWorker(Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id));
                Audit::setActivity('Ameangalia wazee wanaosubiri uhakiki ', 'Wazee', 'Pending', '', '');
                return $this->render('with_seventy', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchWithSeventy(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia wazee wanaosubiri uhakiki', 'Wazee', 'Pending', '', '');
                return $this->render('with_seventy', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }


    public function actionRejected()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('DataClerk')) {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchRejectedBYDistrictOfficer(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia wazee waliokataliwa maombi ', 'Wazee', 'Rejected', '', '');
                return $this->render('rejected', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchRejected(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia wazee waliokataliwa maombi ', 'Wazee', 'Rejected', '', '');
                return $this->render('rejected', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }


    public function actionVetted()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('DataClerk')) {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchVettedMzeeByDistrictWorker(Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id));
                Audit::setActivity('Ameangalia wazee waliohakikiwa ', 'Wazee', 'Vetted', '', '');
                return $this->render('vetted', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchVetted(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia wazee waliohakikiwa ', 'Wazee', 'Vetted', '', '');
                return $this->render('vetted', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    //suspended

    public function actionSuspended()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('DataClerk')) {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchSuspendedMzeeByDistrictWorker(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia wazee waliositishiwa huduma ', 'Wazee', 'Suspended', '', '');
                return $this->render('suspended', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchSuspended(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia wazee waliositishiwa huduma ', 'Wazee', 'Suspended', '', '');
                return $this->render('suspended', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);

            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    public function actionNewDead()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new Mzee();

            if ($model->load(Yii::$app->request->post())) {
                $model1 = $this->findModel($_POST['Mzee']['id']);
                $model1->death_reported_date = date('Y-m-d');
                if ($model1 != null) {
                    $model1->tarehe_kufariki = $_POST['Mzee']['tarehe_kufariki'];
                    $model1->aliyeleta_taarifa_kifo = $_POST['Mzee']['aliyeleta_taarifa_kifo'];
                    $model1->status = Mzee::SUSPENDED;
                    $model1->anaishi = Mzee::DIED;

                    $model1->mchukua_taarifa_kufariki = Yii::$app->user->identity->username;
                    $model1->death_reported_date = $_POST['Mzee']['death_reported_date'];
                    $model->muda_kufariki_save = date('Y-m-d H:i');
                    $model1->save(false);
                }
                Audit::setActivity('Ameingiza mzee aliyefariki wazee waliositishiwa huduma ', 'Wazee', 'Suspended', '', '');

                return $this->redirect(['died']);
            } else {
                return $this->render('kufariki', [
                    'model' => $model,
                ]);
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    public function actionDied()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new MzeeSearch();
            $dataProvider = $searchModel->searchDied(Yii::$app->request->queryParams);
            Audit::setActivity('Ameangalia wazee waliofariki ', 'Wazee', 'Died', '', '');
            return $this->render('died', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    /**
     * Deletes an existing Mzee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionApprove($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);
            $zupsAge = ZupsProduct::getAge($model->zups_pension_type);
            if ($model->mzawa_zanzibar == 'N') {

                $date = date($model->tarehe_kuingia_zanzibar);
                $date_1 = new DateTime($date);
                $date_2 = new DateTime(date('Y-m-d H:i:s'));

                $difference = $date_2->diff($date_1);
                if ($difference->y >= 10) {
                    if ($model->umri_sasa >= $zupsAge) {

                        Mzee::updateAll(['status' => Mzee::ELIGIBLE], ['id' => $id]);
                        Yii::$app->session->setFlash('', [
                            'type' => 'warning',
                            'duration' => 1500,
                            'icon' => 'fa fa-check',
                            'message' => 'Udhibitisho umefanyika kikamilifu',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        Audit::setActivity('Udhibitisho umefanyika kikamilifu ' . $model->id, 'Wazee', 'Approve', '', '');

                        return $this->redirect(['view', 'id' => $id]);
                    } else {
                        Yii::$app->session->setFlash('', [
                            'type' => 'danger',
                            'duration' => 3000,
                            'icon' => 'fa fa-warning',
                            'message' => 'Umri wa mzee haukidhi vigezo vya kupewa pencheni',
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                        Audit::setActivity('Umri wa mzee haukidhi vigezo vya kupewa pencheni ' . $model->id, 'Wazee', 'Approve', '', '');

                        return $this->redirect(['view', 'id' => $id]);
                    }
                } else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'danger',
                        'duration' => 3000,
                        'icon' => 'fa fa-warning',
                        'message' => 'Hajatimiza miaka ya kuishi zanzibari kwa kuwa si mzanzibari asilia',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    Audit::setActivity('Hajatimiza miaka ya kuishi zanzibari kwa kuwa si mzanzibari asilia ' . $model->id, 'Wazee', 'Approve', '', '');
                    return $this->redirect(['view', 'id' => $id]);
                }


            } elseif ($model->mzawa_zanzibar == 'Y') {
                if ($model->umri_sasa >= $zupsAge) {

                    Mzee::updateAll(['status' => Mzee::ELIGIBLE], ['id' => $id]);
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'message' => 'Udhibitisho umefanyika kikamilifu',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['view', 'id' => $id]);
                } else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'danger',
                        'duration' => 3000,
                        'icon' => 'fa fa-warning',
                        'message' => 'Umri wa mzee haukidhi vigezo vya kupewa pencheni',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    Audit::setActivity('Umri wa mzee haukidhi vigezo vya kupewa pencheni ' . $model->id, 'Wazee', 'Approve', '', '');

                    return $this->redirect(['view', 'id' => $id]);
                }
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }


    }

    public function actionConfirm($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);
            Mzee::updateAll(['status' => Mzee::VETTED], ['id' => $id]);
            Yii::$app->session->setFlash('', [
                'type' => 'warning',
                'duration' => 1500,
                'icon' => 'fa fa-check',
                'message' => 'Udhibitisho umefanyika kikamilifu',
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

            Audit::setActivity('Udhibitisho umefanyika kikamilifu ' . $model->id, 'Wazee', 'Approve', '', '');

            return $this->redirect(['view', 'id' => $id]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionGetYears($id)
    {
        $date = date('Y-m-d H:i:s', strtotime($id));
        $date_1 = new DateTime($date);
        $date_2 = new DateTime(date('Y-m-d H:i:s'));

        $difference = $date_2->diff($date_1);

// Echo the as string to display in browser for testing
        return $difference->y;
        // return array ( 'years' => $diff->y, 'months' => $diff->m );
    }


    public function actionValidateId($id, $nid)
    {
        $wazee = Mzee::findAll(['aina_ya_kitambulisho' => $id, 'nambar' => $nid]);
        if ($wazee != null) {
            return true;
        } else {
            $wasaidiz = MsaidiziMzee::findAll(['aina_ya_kitambulisho' => $id, 'nambari_ya_kitambulisho' => $nid]);
            if ($wasaidiz != null) {
                return true;
            } else {
                return false;
            }
        }
    }


    //loads all wazee for shehia $id
    public function actionLoadAll($id)
    {
        if (!Yii::$app->user->isGuest) {
            $counts = Mzee::find()
                ->where(['shehia_id' => $id, 'status' => Mzee::ELIGIBLE])
                ->count();
            return $counts;

        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionCalculateTotal($id)
    {
        if (!Yii::$app->user->isGuest) {
            $product = ZupsProduct::find()
                ->where(['product_code' => 'ZUWZ', 'status' => ZupsProduct::ACTIVE])
                ->one();
            return $product->kiasi * $id;

        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionSearch($id)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['view',
                'id' => $id,
            ]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }


    public function actionBulkApproval()
    {

        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('approveBeneficiary')) {
                $action = Yii::$app->request->post('action');
                $selection = (array)Yii::$app->request->post('selection');//typecasting
                if ($selection) {
                    foreach ($selection as $id) {
                        $model = $this->findModel($id);
                        $zupsAge = ZupsProduct::getAge($model->zups_pension_type);
                        if($model->mzawa_zanzibar == 'N'){

                            $date = date($model->tarehe_kuingia_zanzibar);
                            $date_1 = new DateTime($date);
                            $date_2 = new DateTime( date( 'Y-m-d H:i:s' ) );

                            $difference = $date_2->diff($date_1);
                            if($difference->y >= 10){
                                if($model->umri_sasa >= $zupsAge) {

                                    Mzee::updateAll(['status' => Mzee::ELIGIBLE], ['id' => $id]);
                                    Yii::$app->session->setFlash('', [
                                        'type' => 'warning',
                                        'duration' => 1500,
                                        'icon' => 'fa fa-check',
                                        'message' => 'Udhibitisho umefanyika kikamilifu',
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);
                                    Audit::setActivity('Udhibitisho umefanyika kikamilifu '.$model->id,'Wazee','Approve','','');

                                    // return $this->redirect(['view', 'id' => $id]);
                                }else{
                                    Yii::$app->session->setFlash('', [
                                        'type' => 'danger',
                                        'duration' => 3000,
                                        'icon' => 'fa fa-warning',
                                        'message' => 'Umri wa mzee haukidhi vigezo vya kupewa pencheni',
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);
                                    Audit::setActivity('Umri wa mzee haukidhi vigezo vya kupewa pencheni '.$model->id,'Wazee','Approve','','');

                                    // return $this->redirect(['view', 'id' => $id]);
                                }
                            }
                            else{

                                Yii::$app->session->setFlash('', [
                                    'type' => 'danger',
                                    'duration' => 3000,
                                    'icon' => 'fa fa-warning',
                                    'message' => 'Hajatimiza miaka ya kuishi zanzibari kwa kuwa si mzanzibari asilia',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);
                                Audit::setActivity('Hajatimiza miaka ya kuishi zanzibari kwa kuwa si mzanzibari asilia '.$model->id,'Wazee','Approve','','');
                                //return $this->redirect(['view', 'id' => $id]);
                            }


                        }elseif($model->mzawa_zanzibar == 'Y'){
                            if($model->umri_sasa >= $zupsAge) {


                                Mzee::updateAll(['status' => Mzee::ELIGIBLE], ['id' => $id]);

                                Yii::$app->session->setFlash('', [
                                    'type' => 'warning',
                                    'duration' => 1500,
                                    'icon' => 'fa fa-check',
                                    'message' => 'Udhibitisho umefanyika kikamilifu',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);

                                // return $this->redirect(['view', 'id' => $id]);
                            }else{
                                Yii::$app->session->setFlash('', [
                                    'type' => 'danger',
                                    'duration' => 3000,
                                    'icon' => 'fa fa-warning',
                                    'message' => 'Umri wa mzee haukidhi vigezo vya kupewa pencheni',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);
                                Audit::setActivity('Umri wa mzee haukidhi vigezo vya kupewa pencheni '.$model->id,'Wazee','Approve','','');

                                // return $this->redirect(['view', 'id' => $id]);
                            }
                        }
                    }
                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 1500,
                        'icon' => 'fa fa-check',
                        'message' => 'umefanikiwa kukubali ombi/maombi',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['vetted']);
                }
                else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 1500,
                        'icon' => 'fa fa-warning',
                        'message' => 'haujachajua mzee yeyote',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['vetted']);
                }

            }else {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => 'Hauna uwezo huo',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['vetted']);
            }
            //return $this->redirect(['vetted']);

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }


    public function actionWazee($q = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '', 'last' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, majina_mwanzo As text, jina_babu as last')
                ->from('tbl_mzee')
                ->where(['like', 'majina_mwanzo', $q])
                ->orWhere(['like','jina_babu',$q]);
            //->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Mzee::find($id)->majina_mwanzo];
        }
        return $out;
    }


    /**
     * Finds the Mzee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mzee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mzee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionWazeeShehia()
    {
        $searchModel = new MzeeSearch();
        $dataProvider = $searchModel->searchMzeeShehia(Yii::$app->request->queryParams);

        return $this->render('mzee_shehia', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWazeeWote()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('DataClerk')) {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->searchMzeeByDistrictWorker(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya wazee', 'Wazee', 'Index', '', '');
                return $this->render('wote', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                $searchModel = new MzeeSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                Audit::setActivity('Ameangalia orodha ya wazee', 'Wazee', 'Index', '', '');
                return $this->render('wote', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    public function actionSitisha()
    {

        if (!Yii::$app->user->isGuest) {
            $action = Yii::$app->request->post('action');
            $selection = (array)Yii::$app->request->post('selection');//typecasting
            foreach ($selection as $id) {
                Mzee::updateAll(['status' => Mzee::SUSPENDED], ['id' => $id]);
                //do your stuff
                //  $e->status=2;
            }
            Yii::$app->session->setFlash('', [
                'type' => 'success',
                'duration' => 4000,
                'icon' => 'fa fa-check',
                'message' => 'Umefanikiwa kuwa sitisha wazee' . ' ' . count((array)Yii::$app->request->post('selection')),
                'positonY' => 'top',
                'positonX' => 'right',
            ]);
            Audit::setActivity('Sitisha wazee kwa pamoja ', 'Wazee', 'index', '', '');

            return $this->redirect(['index']);
        }

        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionKubali()
    {

        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('approveBeneficiary')) {
                $action = Yii::$app->request->post('action');
                $selection = (array)Yii::$app->request->post('selection');//typecasting
                if ($selection) {
                    foreach ($selection as $id) {
                        $model = $this->findModel($id);
                        $zupsAge = ZupsProduct::getAge($model->zups_pension_type);
                        if($model->mzawa_zanzibar == 'N'){

                            $date = date($model->tarehe_kuingia_zanzibar);
                            $date_1 = new DateTime($date);
                            $date_2 = new DateTime( date( 'Y-m-d H:i:s' ) );

                            $difference = $date_2->diff($date_1);
                            if($difference->y >= 10){
                                if($model->umri_sasa >= $zupsAge) {

                                    Mzee::updateAll(['status' => Mzee::ELIGIBLE], ['id' => $id]);
                                    Yii::$app->session->setFlash('', [
                                        'type' => 'warning',
                                        'duration' => 4000,
                                        'icon' => 'fa fa-check',
                                        'message' => 'Udhibitisho umefanyika kikamilifu kwa wazee' . ' ' . count((array)Yii::$app->request->post('selection')),
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);
                                    Audit::setActivity('Udhibitisho umefanyika kikamilifu '.$model->id,'Wazee','Approve','','');

                                    // return $this->redirect(['view', 'id' => $id]);
                                }else{
                                    Yii::$app->session->setFlash('', [
                                        'type' => 'danger',
                                        'duration' => 3000,
                                        'icon' => 'fa fa-warning',
                                        'message' => 'Umri wa mzee haukidhi vigezo vya kupewa pencheni',
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);
                                    Audit::setActivity('Umri wa mzee haukidhi vigezo vya kupewa pencheni '.$model->id,'Wazee','Approve','','');

                                    // return $this->redirect(['view', 'id' => $id]);
                                }
                            }else{
                                Yii::$app->session->setFlash('', [
                                    'type' => 'danger',
                                    'duration' => 3000,
                                    'icon' => 'fa fa-warning',
                                    'message' => 'Hajatimiza miaka ya kuishi zanzibari kwa kuwa si mzanzibari asilia',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);
                                Audit::setActivity('Hajatimiza miaka ya kuishi zanzibari kwa kuwa si mzanzibari asilia '.$model->id,'Wazee','Approve','','');
                                //return $this->redirect(['view', 'id' => $id]);
                            }


                        }elseif($model->mzawa_zanzibar == 'Y'){
                            if($model->umri_sasa >= $zupsAge) {

                                Mzee::updateAll(['status' => Mzee::ELIGIBLE], ['id' => $id]);
                                Yii::$app->session->setFlash('', [
                                    'type' => 'warning',
                                    'duration' => 4000,
                                    'icon' => 'fa fa-check',
                                    'message' => 'Udhibitisho umefanyika kikamilifu kwa wazee ' . ' ' . count((array)Yii::$app->request->post('selection')),
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);

                                // return $this->redirect(['view', 'id' => $id]);
                            }else{
                                Yii::$app->session->setFlash('', [
                                    'type' => 'danger',
                                    'duration' => 3000,
                                    'icon' => 'fa fa-warning',
                                    'message' => 'Umri wa mzee haukidhi vigezo vya kupewa pencheni',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);
                                Audit::setActivity('Umri wa mzee haukidhi vigezo vya kupewa pencheni '.$model->id,'Wazee','Approve','','');

                                // return $this->redirect(['view', 'id' => $id]);
                            }
                        }
                    }
                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 4000,
                        'icon' => 'fa fa-check',
                        'message' => 'umefanikiwa kukubali ombi/maombi ya wazee' . ' ' . count((array)Yii::$app->request->post('selection')),
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['suspended']);
                }
                else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 1500,
                        'icon' => 'fa fa-warning',
                        'message' => 'haujachajua mzee yeyote',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['suspended']);
                }

            }else {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => 'Hauna uwezo huo',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['suspended']);
            }
            //return $this->redirect(['vetted']);

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }


    public function actionApprovalWithSeventy()
    {

        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('approveBeneficiary')) {
                $action = Yii::$app->request->post('action');
                $selection = (array)Yii::$app->request->post('selection');//typecasting
                if ($selection) {
                    foreach ($selection as $id) {
                        $model = $this->findModel($id);
                        $zupsAge = ZupsProduct::getAge($model->zups_pension_type);
                        if($model->mzawa_zanzibar == 'N'){

                            $date = date($model->tarehe_kuingia_zanzibar);
                            $date_1 = new DateTime($date);
                            $date_2 = new DateTime( date( 'Y-m-d H:i:s' ) );

                            $difference = $date_2->diff($date_1);
                            if($difference->y >= 10){
                                if($model->umri_sasa >= $zupsAge) {

                                    Mzee::updateAll(['status' => Mzee::ELIGIBLE], ['id' => $id]);
                                    Yii::$app->session->setFlash('', [
                                        'type' => 'warning',
                                        'duration' => 4000,
                                        'icon' => 'fa fa-check',
                                        'message' => 'Udhibitisho umefanyika kikamilifu kwa wazee' . ' ' . count((array)Yii::$app->request->post('selection')),
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);
                                    Audit::setActivity('Udhibitisho umefanyika kikamilifu '.$model->id,'Wazee','Approve','','');

                                    // return $this->redirect(['view', 'id' => $id]);
                                }else{
                                    Yii::$app->session->setFlash('', [
                                        'type' => 'danger',
                                        'duration' => 3000,
                                        'icon' => 'fa fa-warning',
                                        'message' => 'Umri wa mzee haukidhi vigezo vya kupewa pencheni',
                                        'positonY' => 'top',
                                        'positonX' => 'right'
                                    ]);
                                    Audit::setActivity('Umri wa mzee haukidhi vigezo vya kupewa pencheni '.$model->id,'Wazee','Approve','','');

                                    // return $this->redirect(['view', 'id' => $id]);
                                }
                            }else{
                                Yii::$app->session->setFlash('', [
                                    'type' => 'danger',
                                    'duration' => 3000,
                                    'icon' => 'fa fa-warning',
                                    'message' => 'Hajatimiza miaka ya kuishi zanzibari kwa kuwa si mzanzibari asilia',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);
                                Audit::setActivity('Hajatimiza miaka ya kuishi zanzibari kwa kuwa si mzanzibari asilia '.$model->id,'Wazee','Approve','','');
                                //return $this->redirect(['view', 'id' => $id]);
                            }


                        }elseif($model->mzawa_zanzibar == 'Y'){
                            if($model->umri_sasa >= $zupsAge) {

                                Mzee::updateAll(['status' => Mzee::ELIGIBLE], ['id' => $id]);
                                Yii::$app->session->setFlash('', [
                                    'type' => 'warning',
                                    'duration' => 4000,
                                    'icon' => 'fa fa-check',
                                    'message' => 'Udhibitisho umefanyika kikamilifu kwa wazee ' . ' ' . count((array)Yii::$app->request->post('selection')),
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);

                                // return $this->redirect(['view', 'id' => $id]);
                            }else{
                                Yii::$app->session->setFlash('', [
                                    'type' => 'danger',
                                    'duration' => 3000,
                                    'icon' => 'fa fa-warning',
                                    'message' => 'Umri wa mzee haukidhi vigezo vya kupewa pencheni',
                                    'positonY' => 'top',
                                    'positonX' => 'right'
                                ]);
                                Audit::setActivity('Umri wa mzee haukidhi vigezo vya kupewa pencheni '.$model->id,'Wazee','Approve','','');

                                // return $this->redirect(['view', 'id' => $id]);
                            }
                        }
                    }
                    Yii::$app->session->setFlash('', [
                        'type' => 'success',
                        'duration' => 4000,
                        'icon' => 'fa fa-check',
                        'message' => 'umefanikiwa kukubali ombi/maombi ya wazee' . ' ' . count((array)Yii::$app->request->post('selection')),
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['with-seventy']);
                }
                else {
                    Yii::$app->session->setFlash('', [
                        'type' => 'warning',
                        'duration' => 1500,
                        'icon' => 'fa fa-warning',
                        'message' => 'haujachajua mzee yeyote',
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

                    return $this->redirect(['with-seventy']);
                }

            }else {
                Yii::$app->session->setFlash('', [
                    'type' => 'warning',
                    'duration' => 1500,
                    'icon' => 'fa fa-warning',
                    'message' => 'Hauna uwezo huo',
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

                return $this->redirect(['with-seventy']);
            }
            //return $this->redirect(['vetted']);

        }else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

}
