<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_accdaily_bal".
 *
 * @property integer $id
 * @property string $branch_code
 * @property string $account
 * @property string $value_date
 * @property string $available_balance
 * @property string $Debit_tur
 * @property string $Cedit_tur
 */
class AccdailyBal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_accdaily_bal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value_date'], 'safe'],
            [['available_balance', 'Debit_tur', 'Cedit_tur'], 'number'],
            [['account'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'branch_code' => Yii::t('app', 'Branch Code'),
            'account' => Yii::t('app', 'Account'),
            'value_date' => Yii::t('app', 'Value Date'),
            'available_balance' => Yii::t('app', 'Available Balance'),
            'Debit_tur' => Yii::t('app', 'Debit Turnover'),
            'Cedit_tur' => Yii::t('app', 'Credit Turnover'),
        ];
    }

    public static function getBalance($id)
    {
        $balance=AccdailyBal::find()->where(['account'=>$id])->orderBy(['id'=>SORT_DESC])->one();
        if($balance!=null){
            return $balance;
        }
        else{
            return null;
        }
    }

    public static function getCurrentBalance($id)
    {
        $balance=AccdailyBal::find()->where(['account'=>$id])->orderBy(['id'=>SORT_DESC])->one();
        if($balance!=null){
            return $balance->available_balance;
        }
        else{
            return null;
        }
    }


    //updates account balance

    public static function updateAccountBalance($account,$amount,$drcr)
    {

        $balance=AccdailyBal::getBalance($account);


            if($drcr=='C') {
                if($balance!=null) {
                    if($balance->value_date==date('Y-m-d')) {
                        $newbalance = $balance->available_balance + $amount;
                        $cr_tur = $balance->Cedit_tur + $amount;
                        AccdailyBal::updateAll(['available_balance' => $newbalance,'status'=> 'U', 'Cedit_tur' => $cr_tur], ['id' => $balance->id]);
                    }
                    else{
                        $customerbalance=new AccdailyBal();
                        $customerbalance->branch_code=CashierAccount::getZone($account);
                        $customerbalance->value_date=date('Y-m-d');
                        $customerbalance->account=$account;
                        $customerbalance->available_balance=$balance->available_balance+$amount;
                        $customerbalance->Debit_tur=0.00;
                        $customerbalance->Cedit_tur=$amount;
                        $customerbalance->status = 'U';
                        $customerbalance->save();
                    }
                }else {
                    $customerbalance=new AccdailyBal();
                    $customerbalance->branch_code=CashierAccount::getZone($account);
                    $customerbalance->value_date=date('Y-m-d');
                    $customerbalance->account=$account;
                    $customerbalance->available_balance=$amount;
                    $customerbalance->Debit_tur=0.00;
                    $customerbalance->status = 'U';
                    $customerbalance->Cedit_tur=$amount;
                    $customerbalance->save();
                }
            }elseif ($drcr=='D') {
                if ($balance != null) {
                    if($balance->value_date==date('Y-m-d')) {
                        $newbalance = $balance->available_balance - $amount;
                        $dr_tur = $balance->Debit_tur + $amount;
                        AccdailyBal::updateAll(['available_balance' => $newbalance, 'status'=> 'U','Debit_tur' => $dr_tur], ['id' => $balance->id]);
                    }
                    else{
                        $customerbalance=new AccdailyBal();
                        $customerbalance->branch_code=CashierAccount::getZone($account);
                        $customerbalance->value_date=date('Y-m-d');
                        $customerbalance->account=$account;
                        $customerbalance->status = 'U';
                        $customerbalance->available_balance=$balance->available_balance-$amount;
                        $customerbalance->Debit_tur=$amount;
                        $customerbalance->Cedit_tur=0.00;
                        $customerbalance->save();
                    }
                }
            }else{
                $customerbalance=new AccdailyBal();
                $customerbalance->branch_code=CashierAccount::getZone($account);
                $customerbalance->value_date=date('Y-m-d');
                $customerbalance->account=$account;
                $customerbalance->status = 'U';
                $customerbalance->available_balance=$amount;
                $customerbalance->Debit_tur=$amount;
                $customerbalance->Cedit_tur=0.00;
                $customerbalance->save();
            }

    }
}
