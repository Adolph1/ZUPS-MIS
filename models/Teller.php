<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_teller".
 *
 * @property integer $id
 * @property string $reference
 * @property string $product
 * @property string $trn_dt
 * @property string $amount
 * @property string $related_customer
 * @property string $offset_account
 * @property string $offset_amount
 * @property string $status
 * @property string $month
 * @property string $year
 * @property string $maker_id
 * @property string $maker_time
 * @property string $checker_id
 * @property string $checker_time
 */
class Teller extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $customer_number;
    public $current_balance;
    public $pay_point;
    public $kituo_balance;
    public $cashier_id;
    const PENSION = 1;
    const ALLOWANCE = 2;

    public static function tableName()
    {
        return 'tbl_teller';
    }

    public static function getTotalPerMonth()
    {
        $total = Teller::find()->select('amount')->groupBy(['month'])->all();
        return $total;

    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reference','amount','txn_account','pay_point_id',], 'required'],
            [['trn_dt', 'maker_time', 'checker_time'], 'safe'],
            [['amount', 'offset_amount'], 'number'],
            [['pay_point_id','trn_type','related_customer'], 'integer'],
            [['reference', 'product','txn_account', 'offset_account', 'maker_id', 'month','year','checker_id'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
            [['reference'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reference' => Yii::t('app', 'Kumbukumbu Namba'),
            'product' => Yii::t('app', 'kuweka/kutoa'),
            'trn_dt' => Yii::t('app', 'Tarehe ya muamala'),
            'trn_type' => Yii::t('app', 'Aina ya muamala'),
            'amount' => Yii::t('app', 'Kiasi'),
            'txn_account' => Yii::t('app', 'Akaunti ya karani'),
            'related_customer' => Yii::t('app', 'Jina la karani'),
            'offset_account' => Yii::t('app', 'Offset Account'),
            'offset_amount' => Yii::t('app', 'Offset Amount'),
            'pay_point_id' => Yii::t('app', 'Kituo cha malipo'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Aliyetoa pesa'),
            'maker_time' => Yii::t('app', 'Muda aliotoa'),
            'checker_id' => Yii::t('app', 'Aliyepokea'),
            'checker_time' => Yii::t('app', 'Muda aliothibitisha'),
            'cashier_id' =>  Yii::t('app','Jina la karani'),
            'kituo_balance' =>  Yii::t('app','Jumla ya fedha'),
            'month' =>  Yii::t('app','Mwezi'),
            'year' =>  Yii::t('app','Mwaka'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getArrayStatus()
    {
        return [
            self::PENSION => Yii::t('app', 'PENSION'),
            self::ALLOWANCE => Yii::t('app', 'ALLOWANCE'),

        ];
    }


    public static function getIDByReference($id)
    {
        $teller=Teller::find()->where(['reference'=>$id])->one();
        if($teller!=null){
            return $teller->id;
        }
    }

    public static function getAllTransactions($id)
    {
        $transactions=Teller::find()->where(['related_customer'=>$id])->all();
        if($transactions!=null){
            return $transactions;
        }else{
            return null;
        }
    }

    public static function getUnauthorised()
    {
        $unauthorisedcount = Teller::find()
            ->Where(['status'=>'U'])
            ->count();
        if($unauthorisedcount>0){
            return $unauthorisedcount;
        }else{
            return 0;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayPoint()
    {
        return $this->hasOne(Vituo::className(), ['id' => 'pay_point_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashier()
    {
        return $this->hasOne(Wafanyakazi::className(), ['id' => 'related_customer']);
    }


    public static function getCashiers()
    {
        $permissions = AuthItemChild::find()->select('parent')->where(['child' => 'payBeneficiary']);
        $users = AuthAssignment::find()->select('user_id')->where(['in','item_name',$permissions]);
        $staffs = User::find()->select('user_id')->where(['in','id',$users]);
        $accounts = Teller::find()->select('related_customer')->where(['month' => date('m'),'year' => date('Y'),'trn_dt' => date('Y-m-d')]);
        // print_r($users);
        //exit;
        return ArrayHelper::map(Wafanyakazi::find()->where(['in','id',$staffs])->andWhere(['not in','id',$accounts])->andWhere(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)])->all(),'id','jina_kamili');
    }

    public static function getPending($cashier)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $user = User::find()->where(['user_id' => $cashier])->one();
        if($user != null) {


            $pendings = Teller::find()->where(['status' => 'U','related_customer' => $cashier])->all();

            if (count($pendings) > 0) {

                return array('success' => true, 'data' => $pendings);

            } else {

                $cb = Teller::getLastTransactionByUserId($cashier);
                if($cb!=null) {


                    return array('success' => false, 'balance' => $cb);
                }else{
                    return array('success' => false, 'data' => 'No pending');
                }

            }

        }else{
            return array('success' => false, 'data' => 'No such cashier');
        }

    }

    public static function getLastTransactionByUserId($cashier)
    {
        $transaction = Teller::find()->where(['related_customer' => $cashier])->orderBy(['id'=>SORT_DESC])->one();
        if($transaction != null){
            return $transaction->amount;
        }else{
            return null;
        }

    }

    public static function getTransaction($cashier)
    {
        $transaction = Teller::find()->where(['related_customer' => $cashier])->orderBy(['id'=>SORT_DESC])->one();
        if($transaction != null){
            return $transaction;
        }else{
            return null;
        }

    }


}
