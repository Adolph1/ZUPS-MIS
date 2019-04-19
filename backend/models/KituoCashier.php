<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_kituo_cashier".
 *
 * @property integer $id
 * @property integer $cashier_id
 * @property integer $kituo_id
 * @property string $aliyeweka
 * @property string $muda
 *
 * @property TblWafanyakazi $cashier
 * @property TblVituo $kituo
 */
class KituoCashier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kituo_cashier';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cashier_id', 'kituo_id'], 'integer'],
            [['muda'], 'safe'],
            [['aliyeweka'], 'string', 'max' => 200],
            [['cashier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wafanyakazi::className(), 'targetAttribute' => ['cashier_id' => 'id']],
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
            'cashier_id' => Yii::t('app', 'Cashier'),
            'kituo_id' => Yii::t('app', 'Kituo'),
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
        ];
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

   /* public static function getByCashierID($user_id)
    {
            $kituo = KituoCashier::findOne(['cashier_id' => $user_id]);
            if($kituo != null) {
                return $kituo->kituo_id;
            }else{
                return null;
            }
    }*/



    public static function getByCashierID($user_id)
    {
        $kituo = Teller::find()->where(['related_customer' => $user_id,'month'=>date('m'),'year'=>date('Y'),'trn_dt' => date('Y-m-d')])->one();
        if($kituo != null) {
            return $kituo->pay_point_id;
        }else{
            //check from clerk schedule
           $clerk = ClerkKituo::find()->where(['user_id' => $user_id])->orderBy(['id' => SORT_DESC])->one();
            if($clerk != null) {
                return $clerk->kituo_id;
            }else{
                return null;
            }
        }
    }
}
