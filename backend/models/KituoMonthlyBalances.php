<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_kituo_monthly_balances".
 *
 * @property integer $id
 * @property integer $kituo_id
 * @property string $allocated_amount
 * @property string $paid_amount
 * @property string $balance
 * @property string $month
 * @property string $year
 * @property string $allocated_by
 * @property string $allocated_time
 * @property integer $allocated_to
 * @property string $last_access
 * @property string $last_access_user
 *
 * @property TblVituo $kituo
 */
class KituoMonthlyBalances extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $date1;
    public $date2;
    public $wilaya_id;

    public static function tableName()
    {
        return 'tbl_kituo_monthly_balances';
    }

    public static function updateMonthlyBalance($kituo_id, $mwezi, $mwaka, $amount, $cashier_id)
    {
        $kituo = KituoMonthlyBalances::find()->where(['kituo_id' => $kituo_id,'month' => $mwezi,'year' => $mwaka])->one();
        if($kituo != null){
            $newbalance = $kituo->balance - $amount;
            KituoMonthlyBalances::updateAll(['balance' => $newbalance,'paid_amount' => $kituo->paid_amount + $amount,'last_access_user' => User::getUsernameByUserId($cashier_id)],['id' => $kituo->id]);
        }else{
            return ;
        }
    }

    public static function updateMonthlyExpiredBalance($kituo_id, $mwezi, $mwaka, $amount)
    {
        $kituo = KituoMonthlyBalances::find()->where(['kituo_id' => $kituo_id,'month' => $mwezi,'year' => $mwaka])->one();
        if($kituo != null){
            $newbalance = $kituo->balance - $amount;
            KituoMonthlyBalances::updateAll(['balance' => $newbalance,'expired_balance' => $kituo->expired_balance + $amount,'last_access_user' => 'system'],['id' => $kituo->id]);
        }else{
            return ;
        }
    }

    public static function getBalancePerKiwilaya($id,$month)
    {
        $subquery = Vituo::find()->select('id')->where(['wilaya_id' => $id]);
        $vituoBalance = KituoMonthlyBalances::find()->where(['in','kituo_id',$subquery])->andWhere(['month' =>$month,'year' => date('Y')])->sum('allocated_amount');
        if($vituoBalance != null) {
            return $vituoBalance;
        }else{
            return 0;
        }
    }



    public static function getBalancePerKimkoa($id,$month)
    {
        $mkoa = Wilaya::find()->select('id')->where(['mkoa_id' => $id]);
        $subquery = Vituo::find()->select('id')->where(['wilaya_id' => $mkoa]);
        $vituoBalance = KituoMonthlyBalances::find()->where(['in','kituo_id',$subquery])->andWhere(['month' =>$month,'year' => date('Y')])->sum('allocated_amount');
        if($vituoBalance != null) {
            return $vituoBalance;
        }else{
            return 0;
        }
    }

    public static function getBalancePerKiwilayaPaid($id,$month)
    {
        $subquery = Vituo::find()->select('id')->where(['wilaya_id' => $id]);
        $vituoBalance = KituoMonthlyBalances::find()->where(['in','kituo_id',$subquery])->andWhere(['month' => $month,'year' => date('Y')])->sum('paid_amount');
        if($vituoBalance != null) {
            return $vituoBalance;
        }else{
            return 0;
        }
    }


    public static function getBalancePerKimkoaPaid($id,$month)
    {
        $mkoa = Wilaya::find()->select('id')->where(['mkoa_id' => $id]);
        $subquery = Vituo::find()->select('id')->where(['wilaya_id' => $mkoa]);
        $vituoBalance = KituoMonthlyBalances::find()->where(['in','kituo_id',$subquery])->andWhere(['month' => $month,'year' => date('Y')])->sum('paid_amount');
        if($vituoBalance != null) {
            return $vituoBalance;
        }else{
            return 0;
        }
    }


    public static function getBalancePerKiwilayaBalance($id,$month)
    {
        $subquery = Vituo::find()->select('id')->where(['wilaya_id' => $id]);
        $vituoBalance = KituoMonthlyBalances::find()->where(['in','kituo_id',$subquery])->andWhere(['month' => $month,'year' => date('Y')])->sum('balance');
        if($vituoBalance != null) {
            return $vituoBalance;
        }else{
            return 0;
        }
    }



    public static function getBalancePerKituoBalance($id)
    {

        $vituoBalance = KituoMonthlyBalances::find()->where(['kituo_id' => $id])->andWhere(['month' => date('m'),'year' => date('Y')])->one();
        if($vituoBalance != null) {
            return $vituoBalance->allocated_amount;
        }else{
            return 0;
        }
    }

    public static function getLastBalances($id)
    {
        $curentMonth = date('m');
        $previousOne = date('m', strtotime("-1 month"));
        $previousTwo = date('m', strtotime("-2 month"));

        if($curentMonth == 01){
            $vituoBalance = KituoMonthlyBalances::find()->select(['month','balance'])->where(['kituo_id' => $id])->andWhere(['year' => date('Y',strtotime("-1 year"))])->andWhere(['in','month',[$previousOne,$previousTwo]])->all();
           if(count($vituoBalance) > 0){
               return array('success' => true, 'data' => $vituoBalance);
           }

        }elseif($curentMonth == 02){
            $balance1 = KituoMonthlyBalances::find()->select(['month','balance'])->where(['kituo_id' => $id])->andWhere(['year' => date('Y',strtotime("-1 year"))])->andWhere(['month' => $previousTwo])->one();
            $balance12 = KituoMonthlyBalances::find()->select(['month','balance'])->where(['kituo_id' => $id])->andWhere(['year' => date('Y')])->andWhere(['month' => $previousOne])->one();
                return array('success' => true, 'data' => [$balance1,$balance12]);

        }else{
            $vituoBalance = KituoMonthlyBalances::find()->select(['month','balance'])->where(['kituo_id' => $id])->andWhere(['year' => date('Y')])->andWhere(['in','month',[$previousOne,$previousTwo]])->all();
            if(count($vituoBalance) > 0){
                return array('success' => true, 'data' => $vituoBalance);
            }
        }
    }


    public static function getBalancePerKimkoaBalance($id,$month)
    {
        $mkoa = Wilaya::find()->select('id')->where(['mkoa_id' => $id]);
        $subquery = Vituo::find()->select('id')->where(['wilaya_id' => $mkoa]);
        $vituoBalance = KituoMonthlyBalances::find()->where(['in','kituo_id',$subquery])->andWhere(['month' => $month,'year' => date('Y')])->sum('balance');
        if($vituoBalance != null) {
            return $vituoBalance;
        }else{
            return 0;
        }
    }

    public static function getNotPaidPerKituo($pay_point_id)
    {
        $vituoBalance = KituoMonthlyBalances::find()->where(['kituo_id' => $pay_point_id])->andWhere(['month' => date('m'),'year' => date('Y')])->one();
        if($vituoBalance != null) {
            return $vituoBalance->balance;
        }else{
            return 0;
        }
    }

    public static function getPaidPerKituo($pay_point_id)
    {
        $vituoBalance = KituoMonthlyBalances::find()->where(['kituo_id' => $pay_point_id])->andWhere(['month' => date('m'),'year' => date('Y')])->one();
        if($vituoBalance != null) {
            return $vituoBalance->paid_amount;
        }else{
            return 0;
        }
    }

    public static function getPaid($kituo)
    {
        $vituoBalance = KituoMonthlyBalances::find()->where(['kituo_id' => $kituo])->orderBy(['id' => SORT_DESC])->one();
        if($vituoBalance != null) {
            return $vituoBalance->paid_amount;
        }else{
            return 0;
        }
    }

    public static function getBalance($kituo)
    {
        $vituoBalance = KituoMonthlyBalances::find()->where(['kituo_id' => $kituo])->orderBy(['id' => SORT_DESC])->one();
        if($vituoBalance != null) {
            return $vituoBalance->balance;
        }else{
            return 0;
        }
    }


    public static function getExpiredBalance($kituo)
    {
        $vituoBalance = KituoMonthlyBalances::find()->where(['kituo_id' => $kituo])->orderBy(['id' => SORT_DESC])->one();
        if($vituoBalance != null) {
            return $vituoBalance->expired_balance;
        }else{
            return 0;
        }
    }

    public static function getPaidBalancePerZone($getZoneByID,$month,$year)
    {
        $mikoa = Mkoa::find()->select('id')->where(['zone_id' => $getZoneByID]);
        $wilaya = Wilaya::find()->select('id')->where(['in','mkoa_id',$mikoa]);
        $vituo = Vituo::find()->select('id')->where(['in','wilaya_id', $wilaya]);
        $vituoBalance = KituoMonthlyBalances::find()->where(['month' => $month,'year' => $year])->andWhere(['in','kituo_id',$vituo])->sum('paid_amount');
        if($vituoBalance != null) {
            return $vituoBalance;
        }else{
            return 0;
        }
    }

    public static function getBalancePerZone($getZoneByID, $kwa_mwezi, $kwa_mwaka)
    {
        $mikoa = Mkoa::find()->select('id')->where(['zone_id' => $getZoneByID]);
        $wilaya = Wilaya::find()->select('id')->where(['in','mkoa_id',$mikoa]);
        $vituo = Vituo::find()->select('id')->where(['in','wilaya_id', $wilaya]);
        $vituoBalance = KituoMonthlyBalances::find()->where(['month' => $kwa_mwezi,'year' => $kwa_mwaka])->andWhere(['in','kituo_id',$vituo])->sum('balance');
        if($vituoBalance != null) {
            return $vituoBalance;
        }else{
            return 0;
        }
    }

    public static function getPaidPerZone($getZoneByID, $kwa_mwezi, $kwa_mwaka)
    {
        $mikoa = Mkoa::find()->select('id')->where(['zone_id' => $getZoneByID]);
        $wilaya = Wilaya::find()->select('id')->where(['in','mkoa_id',$mikoa]);
        $vituo = Vituo::find()->select('id')->where(['in','wilaya_id', $wilaya]);
        $vituoBalance = KituoMonthlyBalances::find()->where(['month' => $kwa_mwezi,'year' => $kwa_mwaka])->andWhere(['in','kituo_id',$vituo])->sum('paid_amount');
        if($vituoBalance != null) {
            return $vituoBalance;
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
            [['kituo_id', 'allocated_to'], 'integer'],
            [['allocated_amount', 'paid_amount', 'balance','expired_balance'], 'number'],
            [['allocated_time', 'last_access'], 'safe'],
            [['month'], 'string', 'max' => 200],
            [['year'], 'string', 'max' => 200],
            [['allocated_by', 'last_access_user'], 'string', 'max' => 200],
            [['kituo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vituo::className(), 'targetAttribute' => ['kituo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kituo_id' => Yii::t('app', 'Kituo '),
            'allocated_amount' => Yii::t('app', 'Jumla ya fedha'),
            'paid_amount' => Yii::t('app', 'Fedha Waliyolipwa wazee'),
            'balance' => Yii::t('app', 'Fedha iliyobaki'),
            'month' => Yii::t('app', 'Mwezi'),
            'year' => Yii::t('app', 'Mwaka'),
            'allocated_by' => Yii::t('app', 'Allocated By'),
            'allocated_time' => Yii::t('app', 'Allocated Time'),
            'allocated_to' => Yii::t('app', 'Allocated To'),
            'last_access' => Yii::t('app', 'Last Access'),
            'last_access_user' => Yii::t('app', 'Last Access User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKituo()
    {
        return $this->hasOne(Vituo::className(), ['id' => 'kituo_id']);
    }
}
