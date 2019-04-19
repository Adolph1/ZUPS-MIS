<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_kituo_balance".
 *
 * @property integer $id
 * @property integer $kituo_id
 * @property string $credit_turn_over
 * @property string $debit_turn_over
 * @property string $balance
 * @property string $value_dt
 * @property string $updated_by
 * @property string $updated_time
 */
class KituoBalance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kituo_balance';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kituo_id'], 'integer'],
            [['credit_turn_over', 'debit_turn_over', 'balance'], 'number'],
            [['value_dt', 'updated_time'], 'safe'],
            [['updated_by'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kituo_id' => Yii::t('app', 'Kituo'),
            'credit_turn_over' => Yii::t('app', 'Fedha iliyoingia'),
            'debit_turn_over' => Yii::t('app', 'Fedha iliyotoka'),
            'balance' => Yii::t('app', 'Jumla'),
            'value_dt' => Yii::t('app', 'Tarehe'),
            'updated_by' => Yii::t('app', 'Aliyefanya mwamala'),
            'updated_time' => Yii::t('app', 'Muda'),
        ];
    }

    public function getKituo()
    {
        return $this->hasOne(Vituo::className(), ['id' => 'kituo_id']);
    }

    public static function updateKituoBalance($pay_point, $offset_amount, $string)
    {
        if($string == 'D'){
            $kituo = KituoBalance::findOne(['kituo_id' => $pay_point]);
            if($kituo != null) {
                KituoBalance::updateAll(['debit_turn_over' => $kituo->debit_turn_over + $offset_amount,'balance' => $kituo->balance - $offset_amount],['kituo_id' => $pay_point]);
                }else{
                Audit::setActivity('Trying to updated kituo balance while is not yet created','Teller','Update balance','','');
            }
        }
    }
}
