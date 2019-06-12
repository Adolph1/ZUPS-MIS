<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_miamala_watendaji".
 *
 * @property integer $id
 * @property integer $budget_id
 * @property string $tarehe_ya_kupewa
 * @property integer $cashier_id
 * @property integer $kituo_id
 * @property string $kiasi
 * @property integer $jumla_watendaji
 * @property string $kiasi_kilicholipwa
 * @property string $kiasi_kilichobaki
 * @property integer $status
 *
 * @property TblMalipoWatendaji[] $tblMalipoWatendajis
 * @property TblWafanyakazi $cashier
 */
class MiamalaWatendaji extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const PENDING = 0;
    const CLOSED = 1;
    public static function tableName()
    {
        return 'tbl_miamala_watendaji';
    }

    public static function updateBalance($id,$kiasi_alichopewa)
    {
        $model = MiamalaWatendaji::findOne(['id' =>$id, 'status' => MiamalaWatendaji::PENDING]);
        if($model != null){
            if($model->kiasi == $model->kiasi_kilicholipwa){
           // MiamalaWatendaji::updateAll(['kiasi_kilicholipwa' => $model->kiasi_kilicholipwa + $kiasi_alichopewa,'kiasi_kilichobaki' => $model->kiasi - ($model->kiasi_kilicholipwa + $kiasi_alichopewa)],['id' => $id]);
             MiamalaWatendaji::updateAll(['status' => MiamalaWatendaji::CLOSED],['id' => $id]);
            }else{
                MiamalaWatendaji::updateAll(['kiasi_kilicholipwa' => $model->kiasi_kilicholipwa + $kiasi_alichopewa,'kiasi_kilichobaki' => $model->kiasi - ($model->kiasi_kilicholipwa + $kiasi_alichopewa)],['id' => $id]);
            }

        }else{
            return null;
        }
    }

    public static function reverseMuamala($muamala_id, $kiasi_alichopewa)
    {
        $model = MiamalaWatendaji::findOne(['id' =>$muamala_id]);
        MiamalaWatendaji::updateAll(['kiasi_kilicholipwa' => $model->kiasi_kilicholipwa - $kiasi_alichopewa,'kiasi_kilichobaki' => $model->kiasi -($model->kiasi_kilicholipwa - $kiasi_alichopewa)],['id' => $muamala_id]);
    }

    public static function getLastTransactionIDByUserId($user_id)
    {
        $transaction = MiamalaWatendaji::find()->where(['cashier_id' => $user_id])->orderBy(['id'=>SORT_DESC])->one();
        if($transaction != null){
            return $transaction->id;
        }else{
            return null;
        }
    }

    public static function getTotalPaid($budgetId)
    {
        $sum = MiamalaWatendaji::find()->where(['budget_id' => $budgetId])->sum('kiasi_kilicholipwa');
        if($sum != null){
            return $sum;
        }else{
            return 0;
        }
    }

    public static function getCashierId($muamala_id)
    {
        $muamala = MiamalaWatendaji::findOne($muamala_id);
        if($muamala != null){
            return $muamala->cashier_id;
        }else{
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarehe_ya_kupewa'], 'safe'],
            [['cashier_id', 'kituo_id', 'jumla_watendaji', 'status'], 'integer'],
            [['kiasi', 'kiasi_kilicholipwa', 'kiasi_kilichobaki'], 'number'],
            [['cashier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wafanyakazi::className(), 'targetAttribute' => ['cashier_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tarehe_ya_kupewa' => 'Tarehe ya Kupewa',
            'cashier_id' => 'Karani ',
            'kituo_id' => 'Kituo ',
            'kiasi' => 'Kiasi alichopewa',
            'jumla_watendaji' => 'Jumla Watendaji',
            'kiasi_kilicholipwa' => 'Kiasi Kilicholipwa',
            'kiasi_kilichobaki' => 'Kiasi Kilichobaki',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMalipoWatendajis()
    {
        return $this->hasMany(MalipoWatendaji::className(), ['muamala_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashier()
    {
        return $this->hasOne(Wafanyakazi::className(), ['id' => 'cashier_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKituo()
    {
        return $this->hasOne(Vituo::className(), ['id' => 'kituo_id']);
    }

    public static function getCashiers()
    {

        $users = User::find()->select('user_id')->where(['role' => 'Cashier']);
        $accounts = MiamalaWatendaji::find()->select('cashier_id')->where(['tarehe_ya_kupewa' => date('Y-m-d'),'status' => MiamalaWatendaji::PENDING]);
        // print_r($users);
        //exit;
        return ArrayHelper::map(Wafanyakazi::find()->where(['in','id',$users])->andWhere(['not in','id',$accounts])->andWhere(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)])->all(),'id','jina_kamili');
    }

    public static function getLastTransactionByUserId($cashier)
    {
        $transaction = MiamalaWatendaji::find()->where(['cashier_id' => $cashier])->orderBy(['id'=>SORT_DESC])->one();
        if($transaction != null){
            return $transaction->kiasi;
        }else{
            return null;
        }

    }

    public static function getTotalAmountGivenByDate($kituo,$date)
    {
        $transaction = MiamalaWatendaji::find()->where(['kituo_id' => $kituo])->andWhere(['tarehe_ya_kupewa' => $date])->orderBy(['id'=>SORT_DESC])->one();
        if($transaction != null){
            return $transaction->kiasi;
        }else{
            return 0.00;
        }

    }

    public static function getPaid($kituo,$cashier,$date)
    {
        $transaction = MiamalaWatendaji::find()->where(['kituo_id' => $kituo])->andWhere(['between','tarehe_ya_kupewa',$date,date('Y-m-d',strtotime($date. '+3 days'))])->andWhere(['cashier_id' =>$cashier])->orderBy(['id'=>SORT_DESC])->one();
        if($transaction != null){
            return MalipoWatendaji::getPaidByTrnId($transaction->id);
        }else{
            return 0.00;
        }

    }

    public static function getBalance($kituo,$cashier,$date)
    {
        $transaction = MiamalaWatendaji::find()->where(['kituo_id' => $kituo])->andWhere(['between','tarehe_ya_kupewa',$date,date('Y-m-d',strtotime($date. '+3 days'))])->andWhere(['cashier_id' =>$cashier])->orderBy(['id'=>SORT_DESC])->one();
        if($transaction != null){
            return $transaction->kiasi - MalipoWatendaji::getPaidByTrnId($transaction->id);
        }else{
            return 0.00;
        }

    }

}
