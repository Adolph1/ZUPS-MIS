<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_account_bal_setting".
 *
 * @property integer $id
 * @property string $account_class
 * @property string $minimum_balance
 * @property string $maker_id
 * @property string $last_update
 */
class AccountBalSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_account_bal_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_class', 'minimum_balance'], 'required'],
            [['minimum_balance'], 'number'],
            [['last_update'], 'safe'],
            [['account_class', 'maker_id'], 'string', 'max' => 200],
            [['account_class'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'account_class' => Yii::t('app', 'Account Class'),
            'minimum_balance' => Yii::t('app', 'Minimum Balance'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'last_update' => Yii::t('app', 'Last Update'),
        ];
    }

    public static function getBalanceByAccClass($accClass)
    {
        $model=AccountBalSetting::find()->where(['account_class'=>$accClass])->one();
        if($model!=null){
            return $model->minimum_balance;
        }else{
            return null;
        }
    }
}
