<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_cashier_account".
 *
 * @property integer $id
 * @property integer $cashier_id
 * @property string $account
 * @property string $status
 * @property string $opening_balance
 * @property string $current_balance
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblWafanyakazi $cashier
 */
class CashierAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const CLOSED = 'C';

    public static function tableName()
    {
        return 'tbl_cashier_account';
    }

    public static function getCustomerNumberByAccount($txn_account)
    {
        $account=CashierAccount::find()->where(['account'=>$txn_account])->andWhere(['status' => null])->one();
        if($account!=null){
            return $account->cashier_id;
        }else{
            return null;
        }
    }
    public static function geAccountByUserId($cashier_id)
    {
        $account=CashierAccount::find()->where(['cashier_id'=>$cashier_id])->andWhere(['status' => null])->one();
        if($account!=null){
            return $account->account;
        }else{
            return null;
        }
    }

    public static function getZone($account)
    {
        $cashier_id = CashierAccount::getCustomerNumberByAccount($account);
        $zone_id =Wafanyakazi::getZoneByID($cashier_id);
        return $zone_id;
    }

    public static function findLast()
    {
        $model = CashierAccount::find()->orderBy('id DESC')->one();

        if ($model != null) {
            $model->account =sprintf("%04d", $model->account + 1);
            return $model->account;
        }
        else {

            $model = new CashierAccount();
            $model->account = '0001';
            return $model->account;

        }
    }

    public static function getCurrentBalance($cashier)
    {
        $account = CashierAccount::find()->where(['cashier_id' => $cashier])->andWhere(['status' => null])->one();
        if($account != null){
            return $account->current_balance;
        }else{
            return 0.00;
        }
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['cashier_id', 'account'], 'required'],
            [['cashier_id'], 'integer'],
            [['account'], 'unique','message' => 'Account hii inatumika'],
            [['cashier_id'], 'unique','message' => 'Cashier huyu ana-account tayari'],
            [['opening_balance', 'current_balance'], 'number'],
            [['maker_time'], 'safe'],
            [['status'], 'string', 'max' => 1],
            [['account'], 'string', 'max' => 20],
            [['maker_id'], 'string', 'max' => 200],
            [['cashier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wafanyakazi::className(), 'targetAttribute' => ['cashier_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cashier_id' => Yii::t('app', 'Cashier'),
            'account' => Yii::t('app', 'Account'),
            'opening_balance' => Yii::t('app', 'Kiasi Cha Mwanzo'),
            'current_balance' => Yii::t('app', 'Kiasi cha sasa'),
            'maker_id' => Yii::t('app', 'Aliyeweka'),
            'maker_time' => Yii::t('app', 'Muda'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashier()
    {
        return $this->hasOne(Wafanyakazi::className(), ['id' => 'cashier_id']);
    }

}
