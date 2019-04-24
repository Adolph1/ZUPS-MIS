<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_cash_book".
 *
 * @property integer $id
 * @property integer $zone_id
 * @property string $trn_dt
 * @property string $reference_no
 * @property string $amount
 * @property string $gl_account
 * @property string $dr_cr
 * @property string $description
 * @property string $auth_stat
 * @property string $delete_stat
 * @property string $maker_id
 * @property string $maker_time
 */
class CashBook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cash_book';
    }

    public static function getIDByReferenceNo($trn_ref_no)
    {
        $cashbook = CashBook::findOne(['reference_no' => $trn_ref_no]);
        if($cashbook != null){
            return $cashbook->id;
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
            [['trn_dt', 'amount', 'gl_account', 'dr_cr'], 'required'],
            [['trn_dt', 'maker_time'], 'safe'],
            [['amount'], 'number'],
            [['gl_account', 'description', 'maker_id'], 'string', 'max' => 200],
            [['dr_cr', 'auth_stat', 'delete_stat'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_dt' => Yii::t('app', 'Trn Dt'),
            'amount' => Yii::t('app', 'Amount'),
            'gl_account' => Yii::t('app', 'Gl Account'),
            'dr_cr' => Yii::t('app', 'IN/OUT'),
            'description' => Yii::t('app', 'Description'),
            'auth_stat' => Yii::t('app', 'Auth Stat'),
            'delete_stat' => Yii::t('app', 'Delete Stat'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }
}
