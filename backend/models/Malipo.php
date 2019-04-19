<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_malipo".
 *
 * @property integer $id
 * @property integer $voucher_id
 * @property integer $payee_type
 * @property string $siku_kwanza
 * @property string $siku_pili
 * @property string $siku_mwisho
 * @property integer $shehia_id
 * @property integer $mzee_id
 * @property string $kiasi
 * @property string $tarehe_kulipwa
 * @property string $cashier_id
 * @property string $device_number
 * @property integer $kituo_id
 * @property integer $status
 * @property string $aliyelipwa
 * @property string $muda
 * @property integer $verification_type
 * @property string $remarks
 *
 * @property TblMzee $mzee
 * @property TblVoucher $voucher
 */
class Malipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const PAID = 1;
    const PENDING = 0;
    const EXPIRED = -1;
    const SUPPRESSED = -10;
    public $amount;

    public static function tableName()
    {
        return 'tbl_malipo';
    }

    public static function getStatus()
    {
        return [
            self::PAID => Yii::t('app', 'PAID'),
            self::PENDING => Yii::t('app', 'PENDING'),
            self::EXPIRED => Yii::t('app', 'EXPIRED'),
            self::SUPPRESSED => Yii::t('app', 'SUPPRESSED'),
        ];
    }

    public static function getCountFemalePerShehia($voucher_id, $shehia_id)
    {
        $subquery = Malipo::find()->select('mzee_id')->where(['voucher_id' => $voucher_id,'shehia_id'=>$shehia_id]);
        $female = Mzee::find()->where(['in','id',$subquery])->andWhere(['jinsia' => 'F'])->count();
        if($female != null) {
            return $female;
        }else{
            return 0;
        }

    }
    public static function getCountMalePerShehia($voucher_id, $shehia_id)
    {
        $subquery = Malipo::find()->select('mzee_id')->where(['voucher_id' => $voucher_id,'shehia_id'=>$shehia_id]);
        $male = Mzee::find()->where(['in','id',$subquery])->andWhere(['jinsia' => 'M'])->count();
        if($male != null) {
            return $male;
        }else{
            return 0;
        }

    }

    public static function getCountDiedPerShehia($voucher_id, $shehia_id)
    {

        $subquery = Malipo::find()->select('mzee_id')->where(['voucher_id' => $voucher_id,'shehia_id'=>$shehia_id]);
        $died = Mzee::find()->where(['in','id',$subquery])->andWhere(['anaishi' => Mzee::DIED])->andFilterWhere(['between','tarehe_kufariki',date('Y-m-01'),date('Y-m-31')])->count();
        if($died != null) {
            return $died;
        }else{
            return 0;
        }

    }

    public static function getCountPaidPerShehia($voucher_id, $shehia_id)
    {
        $paid = Malipo::find()->where(['voucher_id' => $voucher_id,'shehia_id'=>$shehia_id,'status' => Malipo::PAID])->count();
        if($paid != null) {
            return $paid;
        }else{
            return 0;
        }

    }

    public static function getCountPendingPerShehia($voucher_id, $shehia_id)
    {
        $pending = Malipo::find()->where(['voucher_id' => $voucher_id,'shehia_id'=>$shehia_id,'status' => Malipo::PENDING])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }

    }


    public static function getCountPreviousOnePerShehia($previousOne, $shehia_id)
    {
        $subquery = Voucher::find()->select('id')->where(['mwezi' => $previousOne, 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['shehia_id'=>$shehia_id,'status' => Malipo::PENDING,'voucher_id'=>$subquery])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }


    public static function getCountPreviousTwoPerShehia($previousTwo, $shehia_id)
    {
        $subquery = Voucher::find()->select('id')->where(['mwezi' => $previousTwo, 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['shehia_id'=>$shehia_id,'status' => Malipo::PENDING,'voucher_id'=>$subquery])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }

    public static function getCountPerWilaya($voucher_id, $wilaya_id)
    {
        $wilaya = Shehia::find()->select('id')->where(['wilaya_id' => $wilaya_id]);
       // $subquery = Voucher::find()->select('id')->where(['mwezi' => date('m'), 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['voucher_id'=>$voucher_id])->andWhere(['in','shehia_id',$wilaya])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }

    public static function getcountExpectedPerMonth($month, $year,$wilaya_id)
    {
        $shehias = Shehia::find()->select('id')->where(['wilaya_id' => $wilaya_id]);
        $subquery = Voucher::find()->select('id')->where(['mwezi' => $month, 'mwaka' => $year,'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['voucher_id'=>$subquery])->andWhere(['in','shehia_id',$shehias])->count();
        if($pending != null){
            return $pending;
        }else{
            return null;
        }
    }

    public static function getCountPerKiwilaya($wilaya_id,$month)
    {
        $wilaya = Shehia::find()->select('id')->where(['wilaya_id' => $wilaya_id]);
        $subquery = Voucher::find()->select('id')->where(['mwezi' => $month, 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['voucher_id'=>$subquery])->andWhere(['in','shehia_id',$wilaya])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }


    public static function getMalePerKiwilaya($wilaya_id,$month)
    {
        $wilaya = Shehia::find()->select('id')->where(['wilaya_id' => $wilaya_id]);
        $subquery = Voucher::find()->select('id')->where(['mwezi' => $month, 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wazee = Mzee::find()->select('id')->where(['wilaya_id' => $wilaya_id])->andWhere(['jinsia' => 'M']);
        $pending = Malipo::find()->where(['voucher_id'=>$subquery])->andWhere(['in','shehia_id',$wilaya])->andWhere(['in','mzee_id',$wazee])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }
    public static function getFemalePerKiwilaya($wilaya_id,$month)
    {

        $wilaya = Shehia::find()->select('id')->where(['wilaya_id' => $wilaya_id]);
        $subquery = Voucher::find()->select('id')->where(['mwezi' => $month, 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wazee = Mzee::find()->select('id')->where(['wilaya_id' => $wilaya_id])->andWhere(['jinsia' => 'F']);
        $pending = Malipo::find()->where(['voucher_id'=>$subquery])->andWhere(['in','shehia_id',$wilaya])->andWhere(['in','mzee_id',$wazee])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }


    public static function getCountPerKimkoa($id,$month)
    {
        $mkoa = Wilaya::find()->select('id')->where(['mkoa_id' => $id]);
        $wilaya = Shehia::find()->select('id')->where(['wilaya_id' => $mkoa]);
        $subquery = Voucher::find()->select('id')->where(['mwezi' => $month, 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['voucher_id'=>$subquery])->andWhere(['in','shehia_id',$wilaya])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }

    public static function getCountPerKiwilayaPaid($wilaya_id,$month)
    {
        $wilaya = Shehia::find()->select('id')->where(['wilaya_id' => $wilaya_id]);
        $subquery = Voucher::find()->select('id')->where(['mwezi' => $month, 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['voucher_id'=>$subquery,'status' => Malipo::PAID])->andWhere(['in','shehia_id',$wilaya])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }


    public static function getCountPerKimkoaPaid($id,$month)
    {
        $mkoa = Wilaya::find()->select('id')->where(['mkoa_id' => $id]);
        $wilaya = Shehia::find()->select('id')->where(['wilaya_id' => $mkoa]);
        $subquery = Voucher::find()->select('id')->where(['mwezi' => $month, 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['voucher_id'=>$subquery,'status' => Malipo::PAID])->andWhere(['in','shehia_id',$wilaya])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }

    public static function getToBePaid($id)
    {
        $currentBudget = Budget::getCurrentBudget(Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id));
        if($currentBudget != null) {
            $subquery = Voucher::find()->select('id')->where(['mwezi' => $currentBudget->kwa_mwezi,'mwaka' => $currentBudget->kwa_mwaka, 'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $pending = Malipo::find()->where(['voucher_id' => $subquery])->andWhere(['in', 'kituo_id', $id])->count();
            if ($pending != null) {
                return $pending;
            } else {
                return 0;
            }
        }
    }

    public static function getTotalPerVoucher($id)
    {
        $total = Malipo::find()->where(['voucher_id'=>$id])->sum('kiasi');
        if($total != null) {
            return $total;
        }else{
            return 0.00;
        }
    }



    //get sum of the paid amount per month per district
    public static function getPaidPerKiwilaya($wilaya_id,$month)
    {
        $wilaya = Shehia::find()->select('id')->where(['wilaya_id' => $wilaya_id]);
        $subquery = Voucher::find()->select('id')->where(['mwezi' => $month, 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['voucher_id'=>$subquery,'status' => Malipo::PAID])->andWhere(['in','shehia_id',$wilaya])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }

    public static function getCountPerKiwilayaPending($id,$month)
    {
        $wilaya = Shehia::find()->select('id')->where(['wilaya_id' => $id]);
        $subquery = Voucher::find()->select('id')->where(['mwezi' => $month, 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['voucher_id'=>$subquery,'status' => Malipo::PENDING])->andWhere(['in','shehia_id',$wilaya])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }


    public static function getCountPerKimkoaPending($id,$month)
    {
        $mkoa = Wilaya::find()->select('id')->where(['mkoa_id' => $id]);
        $wilaya = Shehia::find()->select('id')->where(['wilaya_id' => $mkoa]);
        $subquery = Voucher::find()->select('id')->where(['mwezi' => $month, 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['voucher_id'=>$subquery,'status' => Malipo::PENDING])->andWhere(['in','shehia_id',$wilaya])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }

    public static function getCurrentSum()
    {
        $voucher = Voucher::findOne(['mwezi' => date('m'),'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        if($voucher != null) {

            return Malipo::find()->where(['voucher_id' => $voucher->id])->sum('kiasi');
        }

    }

    public static function getWazeeBudget($id)
    {
     $currentBudget = Budget::findOne(['zups_budget_id' => $id]);
        $vouchers = Voucher::find()->where(['mwezi' => $currentBudget->kwa_mwezi,'mwaka' => $currentBudget->kwa_mwaka])->all();
        if($vouchers != null) {

            return $vouchers;
        }

    }

    public static function getSumPerCashierID($getCustomerNumberByAccount,$value_date)
    {
        return Malipo::find()->where(['cashier_id' => $getCustomerNumberByAccount,'tarehe_kulipwa' => $value_date])->sum('kiasi');
    }

    public static function makeExpire()
    {
        $malipo = Malipo::find()->where(['status' => Malipo::PENDING])->andWhere(['<','siku_mwisho',date('Y-m-d')])->all();
        if($malipo != null){
            foreach ($malipo as $mp){

                Malipo::updateAll(['status' => Malipo::EXPIRED],['id' => $mp->id]);
            }

    }
    }

    public static function getPaid($pay_point_id)
    {
        $subquery = Voucher::find()->select('id')->where(['mwezi' => date('m'), 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['voucher_id'=>$subquery,'status' => Malipo::PAID])->andWhere(['in','kituo_id',$pay_point_id])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }

    public static function getNotPaid($pay_point_id)
    {
        $subquery = Voucher::find()->select('id')->where(['mwezi' => date('m'), 'mwaka' => date('Y'),'zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $pending = Malipo::find()->where(['voucher_id'=>$subquery,'status' => Malipo::PENDING])->andWhere(['in','kituo_id',$pay_point_id])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }

    public static function getPaidPerZone()
    {
        $date1 = date('Y-m-01');
        $date2 = date('Y-m-31');
        $subquery = Voucher::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $paid = Malipo::find()->where(['voucher_id'=>$subquery,'status' => Malipo::PAID])->andWhere(['between','tarehe_kulipwa',$date1,$date2])->count();
        if($paid != null) {
            return $paid;
        }else{
            return 0;
        }
    }

    public static function getNotPaidPerZone()
    {

        $subquery = Voucher::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $NotPaid = Malipo::find()->where(['voucher_id'=>$subquery,'status' => Malipo::PENDING])->count();
        if($NotPaid != null) {
            return $NotPaid;
        }else{
            return 0;
        }
    }

    public static function getTotalPaidPerZone()
    {
        $date1 = date('Y-m-01');
        $date2 = date('Y-m-31');
        $subquery = Voucher::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $paid = Malipo::find()->where(['voucher_id'=>$subquery,'status' => Malipo::PAID])->andWhere(['between','tarehe_kulipwa',$date1,$date2])->sum('kiasi');
        if($paid != null) {
            return $paid;
        }else{
            return 0;
        }
    }


    public static function getTotalNotPaidPerZone()
    {
        $subquery = Voucher::find()->select('id')->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $NotPaid = Malipo::find()->where(['voucher_id'=>$subquery,'status' => Malipo::PENDING])->sum('kiasi');
        if($NotPaid != null) {
            return $NotPaid;
        }else{
            return 0;
        }
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['voucher_id', 'shehia_id', 'mzee_id', 'kituo_id', 'status','cashier_id','payee_type','verification_type'], 'integer'],
            [['siku_kwanza', 'siku_pili', 'siku_mwisho', 'tarehe_kulipwa', 'muda'], 'safe'],
            [['kiasi'], 'number'],
            [[ 'device_number','remarks'], 'string', 'max' => 200],
            [['mzee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mzee::className(), 'targetAttribute' => ['mzee_id' => 'id']],
            [['voucher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Voucher::className(), 'targetAttribute' => ['voucher_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'voucher_id' => Yii::t('app', 'Voucher'),
            'siku_kwanza' => Yii::t('app', 'Siku Kwanza'),
            'siku_pili' => Yii::t('app', 'Siku Pili'),
            'siku_mwisho' => Yii::t('app', 'Siku Mwisho'),
            'shehia_id' => Yii::t('app', 'Shehia'),
            'mzee_id' => Yii::t('app', 'Mzee'),
            'kiasi' => Yii::t('app', 'Kiasi'),
            'tarehe_kulipwa' => Yii::t('app', 'Tarehe ya Kulipwa'),
            'cashier_id' => Yii::t('app', 'Cashier'),
            'device_number' => Yii::t('app', 'Device Number'),
            'kituo_id' => Yii::t('app', 'Kituo ID'),
            'status' => Yii::t('app', 'Status'),
            'aliyelipwa' => Yii::t('app', 'Aliyelipwa'),
            'muda' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMzee()
    {
        return $this->hasOne(Mzee::className(), ['id' => 'mzee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVoucher()
    {
        return $this->hasOne(Voucher::className(), ['id' => 'voucher_id']);
    }

    public function getCashier()
    {
        return $this->hasOne(Wafanyakazi::className(), ['id' => 'cashier_id']);
    }

    public function getShehia()
    {
        return $this->hasOne(Shehia::className(), ['id' => 'shehia_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKituo()
    {
        return $this->hasOne(Vituo::className(), ['id' => 'kituo_id']);
    }

    public static function getExpired($param)
    {
        $malipo = Malipo::find()->where(['<=','siku_mwisho', $param])->all();
        if($malipo !=null){

            foreach ($malipo as $mp){
                $mp->status = Malipo::EXPIRED;
                $mp->save();
            }
        }
    }


    public static function getCountPerShehia($voucher_id, $shehia_id)
    {
        $count = Malipo::find()->where(['voucher_id'=>$voucher_id, 'shehia_id'=>$shehia_id])->count();
        return $count;
    }
}
