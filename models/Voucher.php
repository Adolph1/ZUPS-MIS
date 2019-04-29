<?php

namespace backend\models;

use kartik\mpdf\Pdf;
use Yii;
use yii\helpers\ArrayHelper;

ini_set('memory_limit','5048M');

/**
 * This is the model class for table "tbl_voucher".
 *
 * @property integer $id
 * @property string $tarehe_kuandaliwa
 * @property integer $zone_id
 * @property string $kumbukumbu_namba
 * @property string $mwezi
 * @property string $mwaka
 * @property integer $eligible
 * @property string $jumla_fedha
 * @property string $jumla_iliyolipwa
 * @property string $jumla_iliyobaki
 * @property integer $status
 * @property string $aliyeandaa
 * @property string $muda
 *
 * @property TblMalipo[] $tblMalipos
 * @property TblZone $zone
 */
class Voucher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const OPEN = 1;
    const CLOSED = 0;

    public static function tableName()
    {
        return 'tbl_voucher';
    }

    private static function getVoucherIdByMzeeId($id)
    {
        $mzee = Mzee::findOne($id);
        $zone = Mkoa::getZoneByMkoaID($mzee->mkoa_id);
        $mzeeZone = Voucher::findOne(['zone_id' => $zone,'mwezi' => date('m'),'mwaka' => date('Y'),'status' => Voucher::OPEN]);
        if($mzeeZone !=null){
            return $mzeeZone->id;
        }
    }

    public static function saveVoucherAsPdf()
    {
        $vouchers = Voucher::find()->where(['status' => Voucher::CLOSED])->all();
        if($vouchers != null){
            foreach ($vouchers as $voucher){
                $malipo = Malipo::find()->select('shehia_id')->distinct()->where(['voucher_id' => $voucher->id])->all();
                if($malipo != null) {

                    $pdf = new Pdf([
                        'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                        'content' => 'Test',
                        'options' => [
                            'title' => 'Privacy Policy - Krajee.com',
                            'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                        ],
                        'methods' => [
                            'SetHeader' => [' ZUPS - MIS VOUCHER ||Generated On: ' . date("Y-m-d H:i")],
                            'SetFooter' => ['|Wizara ya Kazi, Uwezeshaji, Wazee, Wanawake na Watoto |Page {PAGENO}|'],
                        ]
                    ]);
                    //ob_clean();
                    $pdf->Output('uploads/pdf_file_name.pdf', 'F');
                    exit;
                }
            }
        }
    }

    public static function CloseVoucher()
    {
        $vouchers = Voucher::find()->where(['status' => Voucher::OPEN])->all();

        if($vouchers != null){
            foreach ($vouchers as $voucher){
                $endday = AutomationSettings::findOne(['zone_id' => $voucher->id]);
                $currentDay = date('d');
                if($endday < $currentDay){
                    Voucher::updateAll(['status' => Voucher::CLOSED],['id' => $voucher->id]);

                }
            }
        }
     }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarehe_kuandaliwa', 'muda'], 'safe'],
            [['zone_id', 'eligible', 'status'], 'integer'],
            [['jumla_fedha', 'jumla_iliyolipwa', 'jumla_iliyobaki'], 'number'],
            [['kumbukumbu_namba', 'mwezi', 'mwaka', 'aliyeandaa'], 'string', 'max' => 200],
            [['kumbukumbu_namba'], 'unique'],
            [['zone_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zone::className(), 'targetAttribute' => ['zone_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tarehe_kuandaliwa' => Yii::t('app', 'Tarehe Kuandaliwa'),
            'zone_id' => Yii::t('app', 'Zone'),
            'kumbukumbu_namba' => Yii::t('app', 'Kumbukumbu Namba'),
            'mwezi' => Yii::t('app', 'Mwezi'),
            'mwaka' => Yii::t('app', 'Mwaka'),
            'eligible' => Yii::t('app', 'Eligible'),
            'jumla_fedha' => Yii::t('app', 'Jumla Fedha'),
            'jumla_iliyolipwa' => Yii::t('app', 'Jumla Iliyolipwa'),
            'jumla_iliyobaki' => Yii::t('app', 'Jumla Iliyobaki'),
            'status' => Yii::t('app', 'Status'),
            'aliyeandaa' => Yii::t('app', 'Aliyeandaa'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMalipos()
    {
        return $this->hasMany(Malipo::className(), ['voucher_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZone()
    {
        return $this->hasOne(Zone::className(), ['id' => 'zone_id']);
    }

    public static function NewVoucher()
    {
        $zones = Zone::find()->all();
        if($zones != null){

            foreach ($zones as $zone){
                $budgets = Budget::find()->where(['zone_id' => $zone->id,'status' => Budget::OPEN])->all();
                if($budgets != null) {
                    foreach ($budgets as $budget) {
                        $checkVoucherExistance = Voucher::find()->where(['zone_id' => $zone->id, 'mwezi' => $budget->kwa_mwezi, 'mwaka' => $budget->kwa_mwaka])->one();
                        if ($checkVoucherExistance != null) {

                        } else{

                            $model = new Voucher();
                            $model->tarehe_kuandaliwa = date('Y-m-d');
                            $model->mwezi = $budget->kwa_mwezi;
                            $model->mwaka = $budget->kwa_mwaka;
                            $model->zone_id = $zone->id;
                            $model->status = Voucher::OPEN;
                            $model->kumbukumbu_namba = Reference::findLastVoucher($model->mwezi,$model->mwaka);
                            //print_r($model);
                            //exit;
                            $model->save();

                            $condition = ['and',
                                ['zone_id' => $model->zone_id],
                                ['!=', 'id', $model->id],
                            ];
                            Voucher::updateAll(['status' => Voucher::CLOSED], $condition);
                        }
                    }
                }
            }
        }
    }





    public static function planEligible()
    {
        $vouchers = Voucher::find()->where(['status' => Voucher::OPEN])->all();
        if($vouchers != null){
            foreach ($vouchers as $voucher) {
                $checkPlanningDay = AutomationSettings::getVoucherDay($voucher->zone_id);
                $currentDay = date('d');
                if($currentDay<=$checkPlanningDay){
                    $vchs = Voucher::find()
                        ->select('id')
                        ->where(['status' => Voucher::OPEN,'zone_id' => $voucher->zone_id]);

                    $subquery = Malipo::find()
                        ->select('mzee_id')
                        ->where(['in','voucher_id',$vchs]);
                    $mikoa = Mkoa::find()
                        ->select('id')
                        ->where(['zone_id' => $voucher->zone_id]);
                    $wazee = Mzee::find()->where(['status' => Mzee::ELIGIBLE])->andWhere(['in', 'mkoa_id', $mikoa])->andWhere(['not in','id',$subquery])->all();
                    if($wazee != null){
                        $bugetWazee = 0.00;
                        foreach ($wazee as $mzee) {
                            $mz = Malipo::find()->where(['mzee_id' => $mzee->id])->andWhere(['voucher_id' => $voucher->id])->one();
                            if(count($mz) != 0) {
                                break;
                            }else{
                                $malipo = new Malipo();
                                $malipo->voucher_id = $voucher->id;
                                $malipo->shehia_id = $mzee->shehia_id;
                                $malipo->mzee_id = $mzee->id;
                                $malipo->kituo_id = $mzee->kituo_id;
                                $malipo->kiasi = ZupsProduct::getWazeePension($mzee->zups_pension_type);
                                $day1 = date($voucher->mwaka.'-'.$voucher->mwezi.'-01');
                                $malipo->siku_kwanza = date('Y-m-d', strtotime($day1 . '+' . AutomationSettings::getDayOne($voucher->zone_id) . ' days'));
                                $malipo->siku_pili = date('Y-m-d', strtotime($day1 . '+' . AutomationSettings::getDayTwo($voucher->zone_id) . ' days'));
                                $malipo->siku_mwisho = date('Y-m-d', strtotime($day1 . '+' . AutomationSettings::getDayLast($voucher->zone_id) . ' days'));
                                $malipo->status = Malipo::PENDING;
                                $malipo->save();

                                $isAvailable = KituoMonthlyBalances::findOne(['kituo_id' => $mzee->kituo_id, 'month' => $voucher->mwezi, 'year' => $voucher->mwaka]);
                                if ($isAvailable != null) {

                                    $newBalance = $isAvailable->allocated_amount + $malipo->kiasi;
                                    KituoMonthlyBalances::updateAll(['allocated_amount' => $newBalance, 'balance' => $newBalance], ['id' => $isAvailable->id]);
                                } else {

                                    $checkLastBalance = KituoMonthlyBalances::find()->where(['kituo_id' => $mzee->kituo_id])->orderBy(['id' => SORT_DESC])->one();
                                    if ($checkLastBalance != null) {

                                        $monthlyBalance = new KituoMonthlyBalances();
                                        $monthlyBalance->monthly_eligible_balance =  $monthlyBalance->monthly_eligible_balance + $malipo->kiasi;
                                        $monthlyBalance->kituo_id = $mzee->kituo_id;
                                        $monthlyBalance->allocated_amount = $checkLastBalance->balance + $malipo->kiasi;
                                        $monthlyBalance->paid_amount = 0.00;
                                        $monthlyBalance->balance = $monthlyBalance->allocated_amount;
                                        $monthlyBalance->month = $voucher->mwezi;
                                        $monthlyBalance->year = $voucher->mwaka;
                                        $monthlyBalance->save();

                                    } else {
                                        $monthlyBalance = new KituoMonthlyBalances();
                                        $monthlyBalance->monthly_eligible_balance =  $monthlyBalance->monthly_eligible_balance + $malipo->kiasi;
                                        $monthlyBalance->kituo_id = $mzee->kituo_id;
                                        $monthlyBalance->allocated_amount = $malipo->kiasi;
                                        $monthlyBalance->paid_amount = 0.00;
                                        $monthlyBalance->balance = $malipo->kiasi;
                                        $monthlyBalance->month = $voucher->mwezi;
                                        $monthlyBalance->year = $voucher->mwaka;

                                        $monthlyBalance->save();
                                    }

                                }
                                //updates budget wazee balance
                                $budget = Budget::findOne(['kwa_mwezi' => $voucher->mwezi, 'kwa_mwaka' => $voucher->mwaka,'zone_id' => $voucher->zone_id]);
                                if($budget != null){
                                    $bugetWazee = $budget->wazee + $malipo->kiasi;
                                    Budget::updateAll(['wazee' => $bugetWazee],['kwa_mwezi' => $voucher->mwezi, 'kwa_mwaka' => $voucher->mwaka,'zone_id' => $voucher->zone_id]);
                                }
                            }

                        }
                    }

                }
            }

        }



    }


    public static function getMiezi()
    {

      return ArrayHelper::map(Voucher::find()->select('mwezi')->distinct()->all(),'mwezi', 'mwezi');
    }

    public static function getMwaka()
    {

        return ArrayHelper::map(Voucher::find()->select('mwaka')->distinct()->all(),'mwaka', 'mwaka');
    }
}
